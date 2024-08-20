<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FirewallRule;

class ApplyFirewallRules extends Command
{
    protected $signature = 'firewall:apply';
    protected $description = 'Apply firewall rules to the server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $rules = FirewallRule::all();
        foreach ($rules as $rule) {
            if ($rule->ip_address) {
                $this->applyIpRule($rule);
            } elseif ($rule->ip_range_start && $rule->ip_range_end) {
                $this->applyIpRangeRule($rule);
            } elseif ($rule->port) {
                $this->applyPortRule($rule);
            }
        }
    }

    protected function applyIpRule($rule)
    {
        $action = $rule->action === 'allow' ? 'allow' : 'deny';
        $command = "sudo ufw $action from {$rule->ip_address}";
        exec($command, $output, $return_var);

        // Debug output and return status
        $this->info("Command: $command");
        $this->info("Output: " . implode("\n", $output));
        $this->info("Return Status: $return_var");
    }

    protected function applyIpRangeRule($rule)
    {
        $action = $rule->action === 'allow' ? 'allow' : 'deny';
        $command = "sudo ufw $action from {$rule->ip_range_start} to {$rule->ip_range_end}";
        exec($command, $output, $return_var);

        // Debug output and return status
        $this->info("Command: $command");
        $this->info("Output: " . implode("\n", $output));
        $this->info("Return Status: $return_var");
    }

    protected function applyPortRule($rule)
    {
        $action = $rule->action === 'allow' ? 'allow' : 'deny';
        $command = "sudo ufw $action proto tcp from any to any port {$rule->port}";
        exec($command, $output, $return_var);

        // Debug output and return status
        $this->info("Command: $command");
        $this->info("Output: " . implode("\n", $output));
        $this->info("Return Status: $return_var");
    }
}
