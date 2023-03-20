<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $labels['system_name'] }} | {{ $labels['system_slogan'] }}</title>
    <link rel="icon" type="image/x-icon" href="{{ mix($logos['menu_logo']) }}"/>

    <!-- Styles -->
@yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ mix('vendor/html5shiv/html5shiv.min.js') }}"></script>
    <script src="{{ mix('vendor/html5shiv/html5shiv-printshiv.min.js') }}"></script>
    <script src="{{ mix('vendor/respond/respond.min.js') }}"></script>

    <![endif]-->
</head>

<body class="@stack('body_classes')">

@yield('body')

<!-- Scripts -->
@yield('scripts')

</body>
</html>
