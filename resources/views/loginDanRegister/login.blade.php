<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body
    style="display:flex; justify-content: center; align-items: center; height: 100vh; background-color: #F7F7F7; font-family: 'Sora', sans-serif;">
    <div
        style="height: 350px; display:flex; box-sizing: border-box; background-color: white; border-radius: 20px; box-shadow: 2px 2px 10px grey;">

        <div
            style="box-sizing: border-box; display:flex; flex-direction: column; justify-content: center; height: 100%; width: 330px; background-color: white; padding: 10px; border-top-left-radius: 20px; border-bottom-left-radius: 20px">
            <h2 style="text-align: center; color: rgb(29, 27, 27)">Login</h2>

            <form action="{{ route('cekData') }}" method="POST"
                style="display:flex; flex-direction:column; align-items:center;">

                @csrf

                <input type="text" name="name" value="{{ old('name') }}" placeholder="Username"
                    style="box-sizing:border-box; padding-left:10px; margin:10px 10px 5px 10px; height:40px; width:90%; border:2px solid rgb(112,111,111); border-radius:5px;">

                @error('name')
                    <small style="color:red; width:90%; margin-bottom:5px;">
                        {{ $message }}
                    </small>
                @enderror

                <input type="password" name="password" placeholder="Password"
                    style="box-sizing:border-box; padding-left:10px; margin:10px 10px 5px 10px; height:40px; width:90%; border:2px solid rgb(112,111,111); border-radius:5px;">

                @error('password')
                    <small style="color:red; width:90%; margin-bottom:5px;">
                        {{ $message }}
                    </small>
                @enderror

                <button id="loginBtn" type="submit"
                    style="margin-top:15px; height:40px; width:100px; background-color:rgb(29,27,27); color:white; border:none; font-size:16px; border-radius:8px; cursor:pointer;">
                    Login
                </button>

                @if (session('lockout_seconds'))
                    <small style="color:red; margin-top:10px; text-align:center;">
                        Terlalu banyak percobaan login.
                        Coba lagi dalam
                        <span id="timer">{{ session('lockout_seconds') }}</span>
                        detik.
                    </small>
                @endif

            </form>
        </div>

        <div
            style="height: 100%; width: 330px; background-color: #F7F7F7; border-top-right-radius: 20px; border-bottom-right-radius: 20px; display:flex; justify-content:center; align-items: center">
            <img src="{{ asset('gambar/telkomAkses.png') }}" alt="Logo" style="height: 130px; width: 280px;">
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const timer = document.getElementById('timer');
                const loginBtn = document.getElementById('loginBtn');

                if (timer) {

                    loginBtn.disabled = true;
                    loginBtn.style.opacity = "0.5";
                    loginBtn.style.cursor = "not-allowed";

                    let seconds = parseInt(timer.textContent);

                    const countdown = setInterval(function() {

                        seconds--;

                        timer.textContent = seconds;

                        if (seconds <= 0) {

                            clearInterval(countdown);

                            loginBtn.disabled = false;
                            loginBtn.style.opacity = "1";
                            loginBtn.style.cursor = "pointer";

                            location.reload();
                        }

                    }, 1000);
                }

            });
        </script>
    </div>
</body>
