<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f6f6f6;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Floating background shapes */
        .shape {
            position: absolute;
            opacity: 0.4;
            animation: floatUp 12s infinite linear;
            z-index: 1;
        }

        .circle {
            border-radius: 50%;
            background: rgba(255, 65, 108, 0.25);
        }

        .triangle {
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-bottom: 30px solid rgba(255, 75, 43, 0.25);
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(-150px) rotate(360deg);
                opacity: 0.2;
            }
        }

        .wrapper {
            display: flex;
            flex-direction: row;
            width: 850px;
            max-width: 100%;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            animation: slideUp 0.6s ease;
            z-index: 5;
            position: relative;
        }

        /* Illustration */
        .illustration {
            flex: 1;
            background: linear-gradient(135deg, #FF4B2B, #FF416C);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .illustration i {
            font-size: 70px;
            margin-bottom: 20px;
            animation: bounceIcon 2s infinite ease-in-out;
        }

        .illustration h2 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .illustration p {
            font-size: 15px;
            opacity: 0.9;
            max-width: 260px;
        }

        /* Form */
        .form-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 26px;
            font-weight: 800;
            color: #333;
            margin-bottom: 10px;
        }

        .form-section p {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 45px 15px 15px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background: #f9f9f9;
            font-size: 14px;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #FF416C;
            background: #fff;
            box-shadow: 0 0 6px rgba(255, 65, 108, 0.2);
            outline: none;
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        button {
            background: linear-gradient(135deg, #FF4B2B, #FF416C);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 14px 0;
            border-radius: 25px;
            cursor: pointer;
            font-size: 15px;
            width: 100%;
            margin-top: 10px;
            transition: transform 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
        }

        .back-link {
            display: inline-block;
            margin-top: 18px;
            font-size: 14px;
            color: #FF416C;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes bounceIcon {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .form-section {
                padding: 30px 20px;
            }

            .form-section h1 {
                font-size: 22px;
            }
        }

        @media (max-width: 480px) {
            .illustration i {
                font-size: 55px;
            }

            .illustration h2 {
                font-size: 20px;
            }

            .form-section h1 {
                font-size: 20px;
            }

            button {
                padding: 12px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <!-- Floating background shapes -->
    <div class="shape circle" style="top:10%; left:20%; width:30px; height:30px; animation-duration: 9s;"></div>
    <div class="shape circle" style="top:50%; left:70%; width:40px; height:40px; animation-duration: 14s;"></div>
    <div class="shape circle" style="top:80%; left:30%; width:25px; height:25px; animation-duration: 11s;"></div>
    <div class="shape triangle" style="top:20%; left:80%; animation-duration: 13s;"></div>
    <div class="shape triangle"
        style="top:60%; left:10%; border-left:25px solid transparent; border-right:25px solid transparent; border-bottom:40px solid rgba(255, 75, 43, 0.25); animation-duration: 15s;">
    </div>

    <div class="wrapper">
        <!-- Left Illustration -->
        <div class="illustration">
            <i class="fa fa-user-lock"></i>
            <h2>Admin Reset</h2>
            <p>Admins can securely reset their access credentials anytime.</p>
        </div>

        <!-- Right Form -->
        <div class="form-section">
            <h1>Forgot Password</h1>
            <p>Enter your admin email address to receive a reset link.</p>
            <form id="forgotForm" method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Enter admin email" required />
                    <i class="fa fa-envelope"></i>
                </div>
                <button type="submit">Send Reset Link</button>
            </form>
            <a href="Login.php" class="back-link"><i class="fa fa-arrow-left"></i> Back to Admin Login</a>
        </div>
    </div>
</body>

</html>