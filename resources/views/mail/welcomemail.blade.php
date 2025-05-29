<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
    <p>Hello, {{ $mailmessage }}!</p>
    <p>Welcome to our application.</p>
    <p>Click here to <a href="{{ route('dashboard') }}">go to the dashboard</a>.</p>
</body>
</html>
