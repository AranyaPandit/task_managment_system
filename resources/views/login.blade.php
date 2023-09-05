<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <i class="bi bi-eye-slash" id="togglePassword"></i>
            <br>

            <label for="remember">Remember Password:</label>
            <input type="checkbox" name="remember" id="remember">
            <br>

            <button type="submit">Login</button>
        </form>

        <a href="{{ route('register') }}">Register</a>
      
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("bi-eye");
        });
    </script>
</body>
</html>
