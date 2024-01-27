<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}



        <!-- PrimeVue - Freya  -->
        <link rel="stylesheet" type="text/css" href="/layout/styles/preloading/preloading.css" />
        <link id="theme-link" rel="stylesheet" type="text/css" href="/theme/theme-dark/turquoise/theme.css" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
{{--        <div class="layout-preloader-container">--}}
{{--            <div class="layout-preloader">--}}
{{--                <span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
        @inertia

    </body>
</html>
