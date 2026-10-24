<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name') }}</title>
        @vite('resources/js/app.ts')
        @inertiaHead
    </head>
    <body class="min-h-screen bg-neutral-950 text-neutral-100 antialiased">
        @inertia
    </body>
</html>
