<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="{{ asset('img/login-waves.png') }}">
    <div class="container">
        <div class="img">
            <img src="{{ asset('img/login-bg.svg') }}">
        </div>
        <div class="login-content">
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <img src="{{ asset('img/login-avatar.svg') }}">
                <h2 class="title">TEST-CETTA</h2>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="email" class="input" name="username" id="username" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" required>
                    </div>
                </div>
                <a>Forgot Password?</a>
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>

    @if (session('error'))
        <div id="errorModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h5 style="font-size: 16px;color:red;margin-bottom:5px">{{ session('error') }}</h5>
                <hr>
                <h5 style="margin-top: 5px">Invalid Username or password</h5>
            </div>
        </div>
    @endif

    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
    <script>
        // Modal script
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('errorModal');
            var span = document.getElementsByClassName('close')[0];

            // Show the modal on page load if there's an error session
            @if (session('error'))
                modal.style.display = "block";
            @endif


            span.onclick = function() {
                modal.style.display = "none";
            }


            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
</body>

</html>
