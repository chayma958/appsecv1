<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Firewall Rule</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <label for="action">Action:</label>
                <select name="action" id="action" class="form-control">
                    <option value="allow">Allow</option>
                    <option value="deny">Deny</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Rule</button>
        </form>

        <!-- Delete Form Section -->
        <h2>Existing Firewall Rules</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IP Address</th>
                    <th>IP Range Start</th>
                    <th>IP Range End</th>
                    <th>Port</th>
                    <th>Direction</th>
                    <th>Action</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($firewallRules as $rule)
                    <tr>
                        <td>{{ $rule->id }}</td>
                        <td>{{ $rule->ip_address }}</td>
                        <td>{{ $rule->ip_range_start }}</td>
                        <td>{{ $rule->ip_range_end }}</td>
                        <td>{{ $rule->port }}</td>
                        <td>{{ $rule->direction }}</td>
                        <td>{{ $rule->action }}</td>
                        <td>
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
            $('input[name="ip_type"]').change(function() {
                if ($(this).val() === 'single') {
                    $('#ip-address-group').show();
                    $('#ip-range-group').hide();
                } else {
                    $('#ip-address-group').hide();
                    $('#ip-range-group').show();
                }
            });
        });
    </script>
</body>
</html>
