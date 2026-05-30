<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Desa Digital' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F4FBF7] font-sans text-slate-900 antialiased">
    <div class="mx-auto min-h-screen max-w-7xl pb-24 md:flex md:gap-6 md:p-6">
        @include('components.sidebar')

        <main class="flex-1 overflow-hidden md:rounded-[2rem]">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>

    @include('components.bottom-nav')
</body>
</html>