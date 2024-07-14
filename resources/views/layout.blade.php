<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title','Esi-School ')</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @yield('style','')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <header>
                @include('shared.client.navbar-2')
            </header>
            <!-- Page Content -->
            <main class=" mx-12 mt-16">
                <!-- flash info -->
                @include('shared.flash-alert')
                <!-- fin flash info -->
                <section>
                    @yield('content')
                </section>
            </main>
            <footer>
                @include('shared.client.footer')
            </footer>
        </div>
        @livewireScripts
        @yield('script','')
    </body>
</html>

