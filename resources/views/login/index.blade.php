<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
            text-align: center;
            position: relative;
            transition: all 0.3s;
        }

        .login-container:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, #3498db, #8e44ad);
            clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);
        }

        .login-container:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .login-form {
            padding: 20px;
            box-sizing: border-box;
            position: relative;
            z-index: 2;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #ffffff;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            outline: none;
        }

        .form-group button {
            background-color: transparent;
            color: #ffffff;
            border: 2px solid #ffffff;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .form-group button:hover {
            background-color: #ffffff;
            color: #3498db;
        }

        .bottom-text {
            margin-top: 20px;
            color: #ffffff;
        }
    </style>
</head>
<body>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert("{{ session('success') }}");
            });
        </script>
    @endif


    <div class="login-container">
        <div class="login-form">
            <h2 style="color: #ffffff;">Login From Pakanin</h2>
            <form class="login-form" action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
