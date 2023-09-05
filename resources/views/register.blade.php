<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  
</head>
<body>
    <div class="container">
        <h2>Register</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <div class="password-container">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password1" required>
                <i class="bi bi-eye-slash toggle-password password-toggle" data-target="password1"></i>
            </div>

            <div class="password-container">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password2" required>
                <i class="bi bi-eye-slash toggle-password password-toggle" data-target="password2"></i>
            </div>

            <button type="submit">Register</button>
        </form>

        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>

    <script>
        const togglePasswordIcons = document.querySelectorAll(".toggle-password");

        togglePasswordIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const targetId = this.getAttribute("data-target");
                const password = document.querySelector(`#${targetId}`);

                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                this.classList.toggle("bi-eye");
                this.classList.toggle("bi-eye-slash");
            });
        });
    </script>
</body>
</html>
