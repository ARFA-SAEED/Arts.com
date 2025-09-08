<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ARTS_Admin_Login</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f3f4f6;
            flex-direction: column;
        }

        .custom-alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 8px;
            font-weight: bold;
            color: #fff;
            z-index: 9999;
            transition: opacity 0.6s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .custom-alert.success {
            background-color: #28a745;
        }

        .custom-alert.error {
            background-color: #dc3545;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 780px;
            height: 540px;
            background: #ffffff;
            border-radius: 15px;
            padding: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);

            /* Animation */
            opacity: 0;
            transform: translateY(80px);
            animation: slideUp 0.9s ease forwards;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(80px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section {
            flex: 1;
            padding: 40px;
            background-color: #fff;
        }

        i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff416c !important;
            /* FORCE the pink color */
            font-size: 16px;

        }

        .form-section h2 {
            font-size: 32px;
            font-weight: 700;
            color: #e11d48;
            margin-top: 30px;
            position: relative;
            z-index: 2;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .form-section h2::after {
            content: "LOGIN";
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 64px;
            font-weight: 900;
            color: rgba(0, 0, 0, 0.06);
            letter-spacing: 19px;
            z-index: -1;
            pointer-events: none;
            user-select: none;
        }

        .form-section p {
            margin-top: 16px;
            font-size: 15px;
            color: #6b7280;
        }

        form {
            margin-top: 24px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        /* Input wrapper with right icon */
        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 40px 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-size: 14px;
            transition: border 0.2s, box-shadow 0.2s;
        }

        .input-group input:focus {
            border-color: #f43f5e;
            box-shadow: 0 0 0 2px rgba(244, 63, 94, 0.3);
            outline: none;
        }

        .options {
            margin-top: 12px;
            text-align: right;
        }

        .options a {
            font-size: 14px;
            color: #f43f5e;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        .btn {
            margin-top: 24px;
            width: 100%;
            background: linear-gradient(to right, #FF4B2B, #FF416C);
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover {
            background: #e11d48;
        }

        .image-section {
            flex: 1;
            position: relative;
            display: block;
        }

        .image-section img {
            width: 390px;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .image-section::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            border-top-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                height: auto;
                box-shadow: none;
                max-width: 95%;
                margin: 20px auto;
            }

            .image-section {
                display: block;
                order: -1;
                width: 100%;
                height: 200px;
            }

            .image-section img {
                width: 100%;
                height: 250px;
                object-fit: cover;
            }

            .image-section::after {
                height: 250px;
            }

            .form-section {
                padding: 30px 20px;
            }

            .form-section h2 {
                font-size: 28px;
            }

            .form-section h2::after {
                font-size: 48px;
                letter-spacing: 10px;
            }

            .btn {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .container {
                margin: 15px auto;
                padding: 20px;
            }

            .image-section {
                height: 180px;
            }

            .image-section img {
                height: 180px;
            }

            .image-section::after {
                height: 180px;
            }

            .form-section h2 {
                font-size: 26px;
            }

            .form-section h2::after {
                font-size: 42px;
                letter-spacing: 8px;
            }

            .btn {
                font-size: 15px;
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .form-section h2 {
                font-size: 22px;
            }

            .form-section h2::after {
                font-size: 36px;
                letter-spacing: 5px;
            }

            .options {
                text-align: center;
            }

            .btn {
                padding: 10px;
                font-size: 14px;
            }

            .image-section {
                height: 140px;
            }

            .image-section img {
                height: 140px;
            }

            .image-section::after {
                height: 140px;
            }
        }

        @media (max-width: 360px) {
            .form-section h2 {
                font-size: 20px;
            }

            .form-section h2::after {
                font-size: 30px;
                letter-spacing: 4px;
            }

            .image-section {
                height: 120px;
            }

            .image-section img {
                height: 120px;
            }

            .image-section::after {
                height: 120px;
            }

            .btn {
                padding: 8px;
                font-size: 13px;
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
            // Fade out after 3s
            setTimeout(() => {
                document.querySelectorAll('.custom-alert').forEach(alert => {
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 600);
                });
            }, 2500);

            // ✅ Redirect ONLY if success
            <?php if ($_SESSION['alert_login']['redirect'] === true): ?>
                setTimeout(() => {
                    window.location.href = "../Admin/Dashboard.php";
                }, 3000);
            <?php endif; ?>
        </script>

        <?php unset($_SESSION['alert_login']); ?>
    <?php endif; ?>

    <div class="container">
        <!-- Left Form Section -->
        <div class="form-section">
            <h2>Welcome To Arts</h2>
            <p style="margin-top: 30px;">Login with your email and password</p>

            <form action="Login_query.php" method="POST">
                <!-- Email -->
                <div class="input-group">
                    <input type="email" placeholder="Enter your email" name="email" required />
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <!-- Password -->
                <div class="input-group">
                    <input type="password" placeholder="Enter your password" name="password" required minlength="6" />
                    <i class="fa-solid fa-lock"></i>
                </div>

                <!-- Options -->
                <div class="options">
                    <a href="Forgotten_Password.php">Forgot password?</a>
                </div>

                <!-- Sign In Button -->
                <button type="submit" class="btn">Sign in</button>
            </form>
        </div>

        <!-- Right Image Section -->
        <div class="image-section">
            <img src="./images/admin login image.jpg" alt="Login Banner" />
        </div>
    </div>
</body>

</html>