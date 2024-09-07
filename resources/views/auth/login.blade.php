<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | Web Security Application</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
            text-align: center;
            animation: scaleUp 0.5s ease-in-out forwards;
        }
        @keyframes scaleUp {
            from {
                transform: scale(0.95);
            }
            to {
                transform: scale(1);
            }
        }

        h1 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: #4b9fd3; /* Blue accent */
            opacity: 0;
            animation: slideInFromTop 0.7s ease-out forwards;
        }
        @keyframes slideInFromTop {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }

        .input-group label {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #ffffff; /* White label text */
            text-align: left;
        }

        .input-group input {
            padding: 10px;
            border: 1px solid #333;
            border-radius: 6px;
            background-color: #2a2a2a !important;
            color: #e0e0e0;
            width: calc(100% - 20px);
        }

        .input-group input:focus {
            border-color: #4b9fd3; /* Blue accent */
            outline: none;
        }

        button {
            padding: 10px;
            background-color: #4b9fd3; /* Blue accent */
            border: none;
            border-radius: 6px;
            color: #e0e0e0;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #357abd; /* Darker blue */
        }

        .auth-links {
            margin-top: 1rem;
        }
        .auth-links a {
            color: #4b9fd3; /* Blue accent */
            text-decoration: none;
            font-weight: 600;
        }
        .auth-links a:hover {
            text-decoration: underline;
        }

        .focus-outline:focus {
            outline: 2px solid #ff5e5e;
            border-radius: 4px;
        }

        .error-message {
            color: #ff5e5e; /* Red for error messages */
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <!-- Display error messages -->
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="focus-outline">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required class="focus-outline">
            </div>

            <button type="submit">Log in</button>
        </form>

        @if (Route::has('password.request'))
            <div class="auth-links">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        @endif
    </div>
</body>
</html>
