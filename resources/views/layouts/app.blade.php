<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle (inclut Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('style')
    @yield('style1')
    @yield('style2')
</head>

<body class="font-sans antialiased">
    <div class=" bg-gray-100 flex">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar-items')
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen ">
            @include('layouts.navigation')


            <!-- Page Content -->
            <main class="flex-1 p-6 pt-0 mt-0">
                @include('layouts.partials.alert')
                {{ $slot ?? '' }}
                @yield('content')

            </main>
        </div>
    </div>
</body>

</html>
