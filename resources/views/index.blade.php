<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- My CSS -->

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrapcdn.min.css') }}"> --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script>
        function clearConsole() {
            console.clear();
        }
        window.onload = clearConsole;
    </script>
    <title>AdminHub</title>
</head>

<body>
    <!-- SIDEBAR -->
    @include('menu.sidebar')
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        {{-- @include('menu.navbar') --}}
        <!-- NAVBAR -->


        <!-- MAIN -->
        @yield('content')

        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
