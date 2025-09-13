<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login/Signup</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #ffe2e8, #fff0f3);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 20px;
        }

        /* Alerts */
        .custom-alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            position: absolute;
            top: 31px;
            font-weight: 600;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .custom-alert.success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .custom-alert.error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        /* Container */
        .container {
            position: relative;
            width: 100%;
            max-width: 960px;
            min-height: 560px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            opacity: 0;
            transform: translateY(80px);
            animation: containerUp 0.9s ease forwards;
        }

        @keyframes containerUp {
            0% {
                opacity: 0;
                transform: translateY(80px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Panel left with gradient */
        .left {
            flex: 1;
            background: linear-gradient(to bottom right, #ff4b2b, #ff416c);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            text-align: center;
            transition: 0.6s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .left h1 {
            font-size: 34px;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .left p {
            font-size: 15px;
            color: #fff9;
            position: relative;
            z-index: 1;
        }

        .switch-btn {
            margin-top: 25px;
            padding: 10px 25px;
            background: #fff;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            color: #ff416c;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .switch-btn:hover {
            background: #ffe2e8;
        }

        /* Right forms */
        .right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: #fdfdfd;
            padding: 30px;
        }

        .form-box {
            position: absolute;
            width: 80%;
            max-width: 360px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            transition: all 0.6s ease-in-out;
        }

        .form-box h2 {
            text-align: center;
            color: #f43f5e;
            margin-bottom: 15px;
        }

        .form-box p {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        label {
            font-size: 14px;
            color: #374151;
            display: block;
            margin-bottom: 6px;
        }

        .form-group i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff416c !important;
            font-size: 16px;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        input:focus {
            border-color: #ff4b2b;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 75, 43, 0.3);
        }

        /* Forgot link */
        .forgot {
            text-align: right;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 14px;
        }

        .forgot a {
            color: #f43f5e;
            text-decoration: none;
        }

        .forgot a:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 75, 43, 0.2);
        }

        /* Animation for switching */
        .signup-box {
            opacity: 0;
            transform: translateX(100%);
            pointer-events: none;
        }

        .container.active .login-box {
            opacity: 0;
            transform: translateX(-100%);
            pointer-events: none;
        }

        .container.active .signup-box {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
        }

        /* Floating shapes */
        .floating-shape {
            position: absolute;
            opacity: 0.4;
            z-index: 0;
            animation: float 10s infinite ease-in-out alternate;
        }

        .floating-shape.circle {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            top: 20%;
            left: 15%;
        }

        .floating-shape.small-circle {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            top: 70%;
            left: 60%;
        }

        .floating-shape.square {
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.2);
            top: 40%;
            left: 40%;
            transform: rotate(20deg);
        }

        .floating-shape.triangle {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 50px solid rgba(255, 255, 255, 0.15);
            top: 60%;
            left: 25%;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(15deg);
            }

            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }

            .left {
                height: 200px;
                padding: 20px;
            }

            .form-box {
                position: relative;
                width: 100%;
                max-width: none;
                margin-top: 20px;
            }
        }

        @media (max-width: 480px) {
            .left h1 {
                font-size: 28px;
            }

            .switch-btn {
                padding: 8px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION['alert_login'])): ?>
        <div class="custom-alert <?= $_SESSION['alert_login']['type'] ?>">
            <?= htmlspecialchars($_SESSION['alert_login']['message']) ?>
        </div>
        <script>
            setTimeout(() => {
                window.location.href = "<?= $_SESSION['alert_login']['redirect'] ?>";
            }, 3000);
        </script>
        <?php unset($_SESSION['alert_login']); endif; ?>

    <div class="container" id="authContainer">
        <div class="left" id="leftPanel">
            <div class="content">
                <h1>Empowering<br><strong>Creative Employees</strong></h1>
                <p class="tagline">“Because you bring the art to Arts.”</p>
            </div>

            <!-- Floating shapes -->
            <div class="floating-shape circle"></div>
            <div class="floating-shape triangle"></div>
            <div class="floating-shape square"></div>
            <div class="floating-shape small-circle"></div>
        </div>

        <div class="right">
            <!-- Login -->
            <div class="form-box login-box">
                <h2>Employee Login</h2>
                <form method="POST" action="Login_query.php">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" required placeholder="Enter your email">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required placeholder="Enter your password">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <div class="forgot">
                        <a href="Forgotten_Password.php">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn">Sign In</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById("authContainer");
        const switchBtn = document.getElementById("switchBtn");
        let isSignup = false;
        if (switchBtn) {
            switchBtn.addEventListener("click", () => {
                container.classList.toggle("active");
                isSignup = !isSignup;
                switchBtn.textContent = isSignup ? "Go to Login" : "Go to Signup";
            });
        }
    </script>
</body>

</html>