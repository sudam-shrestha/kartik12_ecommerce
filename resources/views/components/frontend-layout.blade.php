<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    @stack('css')
    <style>
        :root {
            --primary: {{ $color->primary }};
            --secondary: {{ $color->secondary }};
            --text: {{ $color->text }};
            --bg: {{ $color->bg }};
        }

        .container{
            width: 86%;
            margin: auto;
        }

        button{
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-(--bg)">
    @include('sweetalert::alert')

    <x-frontend-header />

    <main>
        {{ $slot }}
    </main>

    <x-frontend-footer />



    @stack('js')

</body>

</html>
