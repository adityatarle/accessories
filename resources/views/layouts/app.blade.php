<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Accessories & Cosmetics Store') - {{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="@yield('description', 'Shop premium accessories, cosmetics, jewelry, and fashion items at our online store.')">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Additional CSS -->
        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="flex-1">
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>

        <!-- Chatbot Widget -->
        <div id="chatbot-widget" class="fixed bottom-4 right-4 z-50">
            <!-- Chatbot will be loaded here by Vue.js -->
        </div>

        <!-- Notification Container -->
        <div id="notification-container" class="fixed top-4 right-4 z-50 space-y-2">
            <!-- Notifications will be loaded here by Vue.js -->
        </div>

        <!-- Additional JS -->
        @stack('scripts')
    </body>
</html>
