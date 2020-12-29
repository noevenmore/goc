<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	<link rel="icon" href="img/favicon.png">
	<link rel="stylesheet" href="css/styles.min.css">
</head>
<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    <script src="js/scripts.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
