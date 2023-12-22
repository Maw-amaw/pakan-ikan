<!-- resources/views/error.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
</head>
<body>
    <h1>Login Failed</h1>
    <p>{{ session('error') }}</p>
    <a href="{{ route('login') }}">Back to Login</a>
</body>
</html>
