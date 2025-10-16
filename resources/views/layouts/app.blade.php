<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Contact App' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gradient-to-b from-slate-950 via-slate-900 to-slate-900 text-slate-100 antialiased transition-colors">
    <main class="mx-auto p-6 md:p-8 lg:p-12 max-w-2xl">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>
