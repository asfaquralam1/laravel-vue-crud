<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        input {
            width: 92%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #357ac9;
        }

        .error-box {
            background: #ffe5e5;
            color: #d10000;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h1>Login</h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">

            <input type="password" name="password" placeholder="Password">

            {{-- Login Error --}}
            @if ($errors->has('login_error'))
                <div class="error-box">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any() && !$errors->has('login_error'))
                <div class="error-box">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>