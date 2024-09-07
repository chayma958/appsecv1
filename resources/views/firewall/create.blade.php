
<x-app-layout>
<x-navbar />

<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: #e0e0e0; /* Light text color for readability */
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1e1e1e; /* Slightly lighter dark background for container */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Enhanced shadow for better separation */
            border-radius: 8px;
        }
        h2 {
            margin-top: 0;
            color: #007bff; /* Bright color for headings */
        }
        h3 {
            margin-top: 20px;
            color: #00bfae; /* Different color for subheadings to stand out */
        }
        form {
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #e0e0e0; /* Light color for labels */
        }
        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #444; /* Dark border color */
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #333; /* Dark background for inputs */
            color: #e0e0e0; /* Light text color for inputs */
        }
        .form-group input[type="radio"] {
            margin-right: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s, opacity 0.3s;
        }
        .btn-primary {
            background-color: #007bff; /* Primary button color */
        }
        .btn-danger {
            background-color: #dc3545; /* Danger button color */
        }
        .btn-primary:hover,
        .btn-danger:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #444; /* Dark border color for table */
        }
        th {
            background-color: #007bff; /* Table header color */
            color: #fff; /* Text color for table header */
        }
        tbody tr:nth-child(even) {
            background-color: #1a1a1a; /* Slightly lighter dark color for table rows */
        }
        tbody tr:hover {
            background-color: #333; /* Hover effect color for table rows */
        }
    </style>
    <br><br><br>
<div class="container">
    <div class="bg-blue-500 text-white p-4 rounded-t-lg">
        <h4 class="text-xl font-semibold">Firewall Rules</h4>
    </div>        
    <br><br>
    <form action="{{ route('firewall_rules.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>
                <input type="radio" name="ip_type" value="single" checked> IP Address
            </label>
            <label>
                <input type="radio" name="ip_type" value="range"> IP Address Range
            </label>
        </div>
        <div class="form-group" id="ip-address-group">
            <label for="ip_address">IP Address:</label>
            <input type="text" name="ip_address" id="ip_address" class="form-control">
        </div>
        <div class="form-group" id="ip-range-group" style="display: none;">
            <label for="ip_range_start">IP Range Start:</label>
            <input type="text" name="ip_range_start" id="ip_range_start" class="form-control">
            <label for="ip_range_end">IP Range End:</label>
            <input type="text" name="ip_range_end" id="ip_range_end" class="form-control">
        </div>
        <div class="form-group">
            <label for="port">Port (optional):</label>
            <input type="text" name="port" id="port" class="form-control">
        </div>
        <div class="form-group">
            <label for="direction">Direction:</label>
            <select name="direction" id="direction" class="form-control">
                <option value="inbound">Inbound</option>
                <option value="outbound">Outbound</option>
            </select>
        </div>
        <div class="form-group">
            <label for="action">Action:</label>
            <select name="action" id="action" class="form-control">
                <option value="allow">Allow</option>
                <option value="deny">Deny</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Rule</button>
    </form>

    <h2>Firewall Rules</h2>

    <!-- Whitelist Table -->
    <h3>Whitelist</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Port</th>
                <th>Direction</th>
                <th>Action</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($whitelistRules as $rule)
            <tr>
                <td>{{ $rule->id }}</td>
                <td>
            @if($rule->ip_address)
                {{ $rule->ip_address }}
            @elseif($rule->ip_range_start && $rule->ip_range_end)
                {{ $rule->ip_range_start }} - {{ $rule->ip_range_end }}
            @endif
        </td>                <td>{{ $rule->port }}</td>
                <td>{{ $rule->direction }}</td>
                <td>{{ $rule->action }}</td>
                <td>
                    <!-- Remove Button -->
                    <form action="{{ route('firewall_rules.destroy', $rule->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Blacklist Table -->
    <h3>Blacklist</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Port</th>
                <th>Direction</th>
                <th>Action</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blacklistRules as $rule)
            <tr>
                <td>{{ $rule->id }}</td>
                <td>{{ $rule->ip_address }}</td>
                <td>{{ $rule->port }}</td>
                <td>{{ $rule->direction }}</td>
                <td>{{ $rule->action }}</td>
                <td>
                    <!-- Remove Button -->
                    <form action="{{ route('firewall_rules.destroy', $rule->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ipTypeRadios = document.querySelectorAll('input[name="ip_type"]');
        const ipAddressGroup = document.getElementById('ip-address-group');
        const ipRangeGroup = document.getElementById('ip-range-group');

        ipTypeRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === 'range') {
                    ipAddressGroup.style.display = 'none';
                    ipRangeGroup.style.display = 'block';
                } else {
                    ipAddressGroup.style.display = 'block';
                    ipRangeGroup.style.display = 'none';
                }
            });
        });
    });
</script>
</x-app-layout>