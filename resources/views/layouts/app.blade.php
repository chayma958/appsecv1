<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
.flexy {
    display: flex;
    align-items: center; /* Center items vertically */
    gap: 40px; /* Adjust the value as needed */
}



.dropdown-menu {
    display: none;
    position: absolute;
    background: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 0.375rem;
    z-index: 10;
}

.dropdown-menu.hidden {
    display: block;
}



        /* Buttons */
button {
    background-color: #4b9fd3;
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

button:hover {
    background-color: #357abd; /* Darker shade on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}
h1, h2, h3, h4, h5, h6 {
    color: #e0e0e0; /* Light text color */
    font-weight: 600; /* Consistent font weight */
}

p, ul, li {
    color: #c0c0c0; /* Slightly lighter color for paragraphs and lists */
    line-height: 1.6; /* Improved line height for readability */
}

/* Link Styles */
a {
    color: #4b9fd3; /* Primary color */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
    color: #357abd; /* Darker shade of primary color */
}

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #121212; /* Dark background */
            color: #e0e0e0; /* Light text color */
        }
        .page-container {
            display: flex;
            min-height: 100vh;
            background-color: #1e1e1e; /* Darker background for content area */
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.8); /* Inner shadow for a more refined look */
        }
        .sidebar {
            width: 250px;
            background-color: #1c1c1c; /* Slightly lighter than the main background */
            border-right: 1px solid #333; /* Darker border */
            padding: 1rem;
            height: 100vh; /* Full height */
            transition: transform 0.3s ease; /* Smooth transition for responsive */
        }
        .sidebar h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #9ed9fc; /* Primary color */
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6); /* Light shadow for text */
        }
        .sidebar ul {
            list-style-type: none;
            padding-left: 1rem; /* Left padding for list items */
            margin: 0;
        }
        .sidebar ul li {
            margin-bottom: 0.5rem;
        }
        .sidebar a {
            color: #4b9fd3; /* Primary color */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease, text-shadow 0.3s ease; /* Smooth transition for color and shadow */
        }
        .sidebar a:hover {
            text-decoration: underline;
            color: #357abd; /* Darker shade of primary color */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4); /* Shadow on hover */
        }
        .main-content {
    flex: 1;
    padding: 1.5rem;
    background-color: #1e1e1e; /* Slightly lighter than the body background */
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6); /* Enhanced shadow for depth */
    overflow-y: auto; /* Add scroll if content overflows */
}

        .bg-white {
            background-color: #1c1c1c; /* Dark background for elements */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); /* Shadow for elements */
        }
        .text-gray-500, .text-gray-800 {
            color: #e0e0e0; /* Light text color */
        }
        .border-gray-100, .border-gray-200 {
            border-color: #333; /* Darker border color */
        }
        .hover\:text-gray-700:hover {
            color: #e0e0e0; /* Light text color on hover */
        }
        /* Mobile Navigation */
@media (max-width: 768px) {
    .page-container {
        display: block; /* Stack sidebar and content vertically */
    }

    .sidebar {
        width: 100%; /* Full width on mobile */
        transform: translateX(-100%); /* Initially hidden */
    }

    .sidebar.open {
        transform: translateX(0); /* Show on toggle */
    }

    .main-content {
        margin-top: 1rem; /* Spacing below the header */
    }
}
.bar {
    background-color: #121000;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border-bottom: 1px solid #2a2a2a; /* Lighter line at the bottom */
}
/* Style for the Profile Heading */
/* Style for the Profile Heading */
.profile-heading {
    margin-left: 20px;
    font-size: 1.25rem; /* Prominent font size */
    font-weight: 800; /* Extra bold text */
    color: #f5f5f5; /* Very light text color */
    text-shadow: 0 6px 8px rgba(0, 0, 0, 0.3), 0 2px 4px rgba(0, 0, 0, 0.2); /* Deeper text shadow for added depth */
    padding: 1rem; /* Generous padding */
    border-radius: 12px; /* Slightly larger border radius for a softer look */
    background-color: #055991; /* Dark background */
    display: inline-block; /* Correct padding and background application */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4), inset 0 2px 4px rgba(0, 0, 0, 0.2); /* Enhanced outer and inner shadow */
}



    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bar">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
function toggleDropdown(event) {
    const dropdown = event.currentTarget.nextElementSibling;
    dropdown.classList.toggle('hidden');
}
</script>
    <script src="//js.pusher.com/7.0/pusher.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.10.0/echo.iife.js"></script>
</body>
</html>
