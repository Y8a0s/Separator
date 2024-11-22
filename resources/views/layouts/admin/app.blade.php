<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (Illuminate\Support\Str::startsWith(Illuminate\Support\Facades\Route::currentRouteName(), 'admin.presidency'))
            ریاست
        @else
            مدیریت
        @endif
        | @yield('title')
    </title>
    <link rel="icon" href="{{ Storage::url('images/logos/site_title_icon.png') }}" type="image/icon type">

    <!-- Scripts -->
    @vite(['resources/admin/admin.js', 'resources/admin/admin.scss', 'resources/admin/admin.css'])
    @livewireStyles

</head>

<body class="d-grid">

    @include('layouts.admin.sidebar')

    <div id="app" class="d-grid">
        @include('layouts.admin.header')

        <main class="py-4 bg-white">
            <div class="container h-100">
                {{ $slot }}
            </div>
        </main>
        @include('layouts.admin.footer')
    </div>

    @livewireScripts
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('toastAlert', (icon, title) => {
                Toast.fire({
                    icon: icon,
                    title: title
                });
            });
        });

        document.addEventListener('refresh_page', () => {
            window.location.reload();
        });
    </script>
    @yield('script')
</body>

</html>
