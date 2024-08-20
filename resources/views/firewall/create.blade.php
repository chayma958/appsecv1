<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firewall Rules</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            margin-top: 0;
            color: #007bff;
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
            color: #555;
        }
        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
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
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
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
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Firewall Rule</h2>
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
    $(document).ready(function() {
        $('input[name="ip_type"]').on('change', function() {
            if ($(this).val() === 'range') {
                $('#ip-address-group').hide();
                $('#ip-range-group').show();
            } else {
                $('#ip-address-group').show();
                $('#ip-range-group').hide();
            }
        });
    });
    </script>
</body>
</html>
