<?php
session_start();

if (isset($_SESSION['alert_signup'])) {
    $alert = $_SESSION['alert_signup'];
    echo '<div class="alert alert-' . htmlspecialchars($alert['type']) . '">' . htmlspecialchars($alert['message']) . '</div>';

    // Save the redirect flag
    $should_redirect = isset($alert['redirect']) && $alert['redirect'] === true;

    unset($_SESSION['alert_signup']);
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ARTS_Login & Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        .bg {
            position: relative;
            background-image: url('./images/customer_login_bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .bg::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2000px;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black overlay with 50% opacity */
            z-index: 0;
        }

        .container {
            position: relative;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            width: 768px;
            max-width: 100%;
            height: 550px;
            z-index: 1;
            /* Must be higher than bg::before */
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #fff;
        }

        form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input,
        select {
            background-color: #f0ebeb;
            border: none;
            border-radius: 10px;
            padding: 15px 19px;
            margin: 8px 0;
            width: 100%;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
            border-radius: 20px;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            border-radius: 20px;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: linear-gradient(to right, #FF4B2B, #FF416C);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        .custom-alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 5px;
            font-weight: bold;
            color: #fff;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.6s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .custom-alert.success {
            background-color: #28a745;
        }

        .custom-alert.error {
            background-color: #dc3545;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: bold;
            z-index: 9999;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            z-index: 9999;
            position: absolute;
            top: 38px;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            z-index: 9999;
            background-color: #f8d7da;
            color: #721c24;
            position: absolute;
            top: 40px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body class="bg">
    <?php


    // Handle SIGNUP alerts
    if (isset($_SESSION['alert_signup'])) {
        $alert = $_SESSION['alert_signup'];
        echo '<div class="alert alert-' . htmlspecialchars($alert['type']) . '">' . htmlspecialchars($alert['message']) . '</div>';
        unset($_SESSION['alert_signup']);
    }

    // Handle LOGIN alerts (you can set this in your login.php)
    if (isset($_SESSION['alert_login'])) {
        $alert = $_SESSION['alert_login'];
        echo '<div class="alert alert-' . htmlspecialchars($alert['type']) . '">' . htmlspecialchars($alert['message']) . '</div>';
        unset($_SESSION['alert_login']);
    }
    ?>
    <?php if (isset($_SESSION['alert'])): ?>
        <div class="custom-alert <?= $_SESSION['alert']['type'] ?>">
            <?= $_SESSION['alert']['message'] ?>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>

    <div class="container" id="container" style=" 
    position: relative;
    background-color: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 
                0 10px 10px rgba(0, 0, 0, 0.22);
    width: 768px;
    max-width: 100%;
    height: 550px;
    z-index: 1;
">
        <!-- Sign Up Form -->
        <div class="form-container sign-up-container">
            <form action="Register_query.php" method="POST" enctype="multipart/form-data">
                <h1 style="margin-bottom : 10px;">Create Account</h1>
                <input type="text" placeholder="Username" name="username" required minlength="2" />
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required minlength="6" />
                <button type="submit" name="register" style="margin-top:10px">Sign Up</button>
            </form>
        </div>


        <!-- Sign In Form -->
        <div class="form-container sign-in-container">
            <form action="Login_query.php" method="POST">
                <h1>Sign in</h1>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="custom-alert error">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>
                <input style="margin-top:20px" type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required minlength="6" />
                <a href="#">Forgot your password?</a>
                <button type="submit">Log In</button>
            </form>
        </div>

        <!-- Overlay -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Log in to view your orders, wishlist, and continue shopping with Arts.</p>
                    <button class="ghost" id="signIn">Log In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>New Here?</h1>
                    <p>Create an account to explore unique Stationery, stylish Wallets, Gifts and more.</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        // Auto-hide alerts after 4 seconds
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);

        // Redirect after signup alert (if flagged in PHP)
        <?php if (isset($should_redirect) && $should_redirect): ?>
            setTimeout(() => {
                window.location.href = "../Customer/index.php";
            }, 3500);
        <?php endif; ?>

        <!-- 🔹 ADD LOGIN REDIRECT HERE -->
        <?php if (isset($_SESSION['alert_login']['redirect']) && $_SESSION['alert_login']['redirect']): ?>
            setTimeout(() => {
                window.location.href = "../Customer/index.php";
            }, 3000);
        <?php endif; ?>
    </script>

</body>

</html>