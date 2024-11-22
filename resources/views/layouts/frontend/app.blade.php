<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>

    {!! SEOMeta::generate(true) !!}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ Storage::url('images/logos/site_title_icon.png') }}" type="image/icon type">
    @livewireStyles
    @vite(['resources/js/app.js', 'resources/sass/app.scss', 'resources/css/app.css'])
</head>

<body>

    <div id="app" class="px-2 px-md-3">

        @include('layouts.frontend.header')

        <main class="px-4 py-5 bg-white shadow overflow-hidden @if (! inRoute('home')) site-background @endif">
            {{ $slot }}
        </main>

        @include('layouts.frontend.footer')

    </div>

    <script>
        document.addEventListener('refresh_page', () => {
            window.location.reload();
        });
    </script>

@livewireScripts
@yield('script')
</body>

</html>
