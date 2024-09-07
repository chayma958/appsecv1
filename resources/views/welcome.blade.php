<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Project Security</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                margin: 0;
                font-family: 'Figtree', sans-serif;
                background-color: #121212;
                color: #f5f5f5;
                line-height: 1.6;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
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
                max-width: 600px;
                width: 100%;
                padding: 20px;
                background-color: #1e1e1e;
                border-radius: 10px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
                text-align: center;
                transform: scale(0.95);
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
                font-size: 2rem;
                margin-bottom: 1rem;
                color: #4bbaee;
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

            p {
                font-size: 1.125rem;
                margin-bottom: 1.5rem;
                opacity: 0;
                animation: fadeIn 1.2s ease-in-out forwards;
                animation-delay: 0.5s;
            }

            .auth-links {
                display: flex;
                justify-content: center;
                gap: 10px; /* Reduced gap to bring buttons closer */
                margin-top: 1rem;
            }
            .auth-links a {
                padding: 10px 20px;
                text-decoration: none;
                font-weight: 600;
                color: #f5f5f5;
                background-color: #4bbaee;
                border-radius: 6px;
                transition: background-color 0.3s ease, color 0.3s ease;
                opacity: 0;
                animation: slideInFromBottom 0.8s ease-out forwards;
                animation-delay: 0.8s;
            }
            @keyframes slideInFromBottom {
                from {
                    transform: translateY(20px);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .auth-links a:hover {
                background-color: #f5f5f5;
                color: #1e1e1e;
            }

    
            @keyframes rotateIn {
                from {
                    transform: rotate(-90deg);
                    opacity: 0;
                }
                to {
                    transform: rotate(0);
                    opacity: 1;
                }
            }

       

            .focus-outline:focus {
                outline: 2px solid #ff5e5e;
                border-radius: 4px;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            <h1>Project Security</h1>
            <p>Manage your server's security settings and monitor threats in real-time.</p>
            
            @if (Route::has('login'))
                <div class="auth-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="focus-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="focus-outline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="focus-outline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>


    </body>
</html>
