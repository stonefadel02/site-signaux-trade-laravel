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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                {{ $slot ?? '' }}
                @yield('content')

            </main>
        </div>
    </div>
</body>

</html>
