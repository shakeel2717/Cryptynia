<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <h2>Landing Page</h2>
    <a href="{{ route('login') }}">Login In</a>
    <a href="{{ route('register') }}">Create Account</a>
</body>
</html>