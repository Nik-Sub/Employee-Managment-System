{{-- Created by Boris Martinovic 2020/0582 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('js/jquery-3.6.4.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('pageJS')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('additionCSS')
</head>
<body>
    @yield('sideNav')
    @yield('mainContent')
</body>
</html>