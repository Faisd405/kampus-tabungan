<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Tabungan Siswa</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @if (auth()->user())
                @include('components.layouts.navbar')
                @include('components.layouts.sidebar')
            @endif
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            @if (auth()->user())
                @include('components.layouts.footer')
            @endif
        </div>
    </div>

    @stack('modal')

    @include('components.layouts.script')
    @stack('page-script')
</body>

</html>
