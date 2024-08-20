<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FirewallRule;

class FirewallRuleController extends Controller
{
    public function create()
    {
        $whitelistRules = FirewallRule::where('action', 'allow')->get();
        $blacklistRules = FirewallRule::where('action', 'deny')->get();
        return view('firewall.create', compact('whitelistRules', 'blacklistRules'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ip_type' => 'required|in:single,range',
            'ip_address' => 'nullable|ip|required_if:ip_type,single',
            'ip_range_start' => 'nullable|ip|required_if:ip_type,range',
            'ip_range_end' => 'nullable|ip|required_if:ip_type,range',
            'port' => 'nullable|integer',
            'direction' => 'required|in:inbound,outbound',
            'action' => 'required|in:allow,deny',  // Ensure this matches ENUM values
        ]);
    
        $firewallRule = new FirewallRule();
        if ($request->ip_type == 'single') {
            $firewallRule->ip_address = $request->ip_address;
        } else {
            $firewallRule->ip_range_start = $request->ip_range_start;
            $firewallRule->ip_range_end = $request->ip_range_end;
        }
        $firewallRule->port = $request->port;
        $firewallRule->direction = $request->direction;
        $firewallRule->action = $request->action;
        $firewallRule->save();
    
        // Apply the firewall rule immediately
        $this->applyFirewallRule($firewallRule);
    
        return redirect()->route('firewall.create')->with('success', 'Firewall rule created and applied successfully.');
    }
    

    protected function applyFirewallRule($rule)
    {
        $direction = $rule->direction === 'inbound' ? 'in' : 'out';
        
        // Determine action command based on the rule's action
        $actionCommand = $rule->action === 'allow' ? 'allow' : 'deny';
        
        // Apply rules based on the type of input
        if ($rule->ip_address) {
            $this->applyIpRule($rule, $direction, $actionCommand);
        } elseif ($rule->ip_range_start && $rule->ip_range_end) {
            $this->applyIpRangeRule($rule, $direction, $actionCommand);
        } elseif ($rule->port) {
            $this->applyPortRule($rule, $direction, $actionCommand);
        }
    }
    
    protected function applyIpRule($rule, $direction, $actionCommand)
    {
        $portPart = $rule->port ? "port {$rule->port}" : '';
        $command = "sudo ufw $actionCommand from {$rule->ip_address} to any $portPart";
        \Log::info("Executing command: $command"); // Add logging
        exec($command);
    }
    protected function applyIpRangeRule($rule, $direction, $actionCommand)
    {
        $ipRange = $this->ipRangeToCidr($rule->ip_range_start, $rule->ip_range_end);
        $portPart = $rule->port ? "port {$rule->port}" : '';
        $command = "sudo ufw $actionCommand from {$ipRange} to any $portPart";
        \Log::info("Executing command: $command"); // Add logging
        exec($command);
    }
    
    

    
    
    protected function applyPortRule($rule, $direction, $actionCommand)
    {
        $portPart = $rule->port ? "port {$rule->port}" : '';
        $command = "sudo ufw $actionCommand to any $portPart";
        \Log::info("Executing command: $command"); // Add logging
        exec($command);
    }
    
    public function destroy($id)
    {
        $rule = FirewallRule::findOrFail($id);

        // Remove the rule from the firewall
        $this->removeFirewallRule($rule);

        // Delete the rule from the database
        $rule->delete();

        // Reapply remaining rules to reflect the changes
        $this->applyFirewallRules();

        // Redirect or return a response
        return redirect()->route('firewall.create')->with('success', 'Firewall rule deleted successfully.');
    }

    // Method to remove the firewall rule from the system
    protected function removeFirewallRule($rule)
    {
        $direction = $rule->direction === 'inbound' ? 'in' : 'out';
        
        // Determine action command based on the rule's action
        $actionCommand = $rule->action === 'allow' ? 'allow' : 'deny';
        
        // Remove rules based on the type of input
        if ($rule->ip_address) {
            $this->removeIpRule($rule, $direction, $actionCommand);
        } elseif ($rule->ip_range_start && $rule->ip_range_end) {
            $this->removeIpRangeRule($rule, $direction, $actionCommand);
        } elseif ($rule->port) {
            $this->removePortRule($rule, $direction, $actionCommand);
        }
    }

    
    protected function removeIpRule($rule, $direction, $actionCommand)
    {
        $portPart = $rule->port ? "port {$rule->port}" : '';
    
        // Ensure that the command does not fail if the port is not specified
        $command = $rule->port ? "sudo ufw delete $actionCommand from {$rule->ip_address} to any $portPart" 
                               : "sudo ufw delete $actionCommand from {$rule->ip_address} to any";
    
        \Log::info("Executing command: $command"); // Add logging
        exec($command);
    }
    

    protected function removeIpRangeRule($rule, $direction, $actionCommand)
    {
        $portPart = $rule->port ? "port {$rule->port}" : '';
        $ipRange = $this->ipRangeToCidr($rule->ip_range_start, $rule->ip_range_end);
        // Ensure that the command does not fail if the port is not specified
        $command = $rule->port ? "sudo ufw delete $actionCommand from {$ipRange} to any $portPart" 
                               : "sudo ufw delete $actionCommand from {$ipRange} to any";
        
        \Log::info("Executing command: $command"); // Add logging
        exec($command);
    }
    
    
    protected function removePortRule($rule, $direction, $actionCommand)
    {
        $portPart = $rule->port ? "port {$rule->port}" : '';
    
        // Ensure that the command does not fail if the port is not specified
        $command = $rule->port ? "sudo ufw delete $actionCommand to any $portPart" 
                               : "sudo ufw delete $actionCommand to any";
    
        \Log::info("Executing command: $command"); // Add logging
        exec($command);
    }
    
    // Apply remaining rules after deletion
    protected function applyFirewallRules()
    {
        $rules = FirewallRule::all();
        foreach ($rules as $rule) {
            $this->applyFirewallRule($rule);
        }
    }


    protected function ipRangeToCidr($startIp, $endIp)
{
    $start = ip2long($startIp);
    $end = ip2long($endIp);

    if ($start > $end) {
        throw new \Exception("Start IP must be less than or equal to End IP");
    }

    $cidrBlocks = [];
    $currentStart = $start;

    while ($currentStart <= $end) {
        // Find the maximum block size that fits within the IP range
        $maxSize = 1;
        while (($currentStart + $maxSize - 1) <= $end) {
            $maxSize *= 2;
        }
        $maxSize /= 2;

        // Calculate prefix length
        $prefixLength = 32;
        while ($maxSize > 1) {
            $maxSize /= 2;
            $prefixLength -= 1;
        }

        // Convert start IP to CIDR block
        $blockStart = long2ip($currentStart);
        $cidrBlocks[] = "{$blockStart}/{$prefixLength}";

        // Move to the next block
        $currentStart += 2 ** (32 - $prefixLength);
    }

    return implode(' ', $cidrBlocks); // Join with space or adjust as needed
}
}    