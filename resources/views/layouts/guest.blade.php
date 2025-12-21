<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Welcome')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome for icons (optional but recommended) -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6 py-12">
        <!-- Logo -->
        <div class="flex justify-center mb-10">
            <a href="/">
                <x-application-logo class="w-24 h-24 fill-current text-indigo-600 drop-shadow-md" />
            </a>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Optional Header Accent -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                    <p class="mt-2 text-gray-600">Sign in to continue to your account</p>
                </div>

                <!-- Slot for form content -->
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-10 py-6 text-center text-sm text-gray-600 border-t border-gray-100">
                Don't have an account?
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-700 ml-1">
                        Sign up here
                    </a>
                @endif
            </div>
        </div>

        <!-- Optional bottom branding -->
        <div class="text-center mt-8 text-sm text-gray-500">
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>

</html>
