<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Forgot Password</title>
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
            padding: 20px;
            background: linear-gradient(135deg, #fff 50%, #ffe6eb 50%);
            position: relative;
            overflow: hidden;
        }

        /* Subtle pattern effect */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 200%;
            height: 200%;
            background-image: radial-gradient(rgba(255, 65, 108, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            transform: rotate(-25deg);
            opacity: 0.5;
            z-index: 0;
        }

        .wrapper {
            background: #fff;
            border-radius: 18px;
            display: flex;
            width: 900px;
            max-width: 100%;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            animation: slideUp 0.6s ease;
            position: relative;
            z-index: 5;
        }

        /* Left Illustration */
        .illustration {
            flex: 1;
            background: linear-gradient(135deg, #FF416C, #FF4B2B);
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
            animation: bounce 2s infinite;
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

        /* Right Form */
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

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .illustration {
                padding: 30px;
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
                font-size: 50px;
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
    <div class="wrapper">
        <!-- Illustration -->
        <div class="illustration">
            <i class="fa fa-user-shield"></i>
            <h2>Forgot Password?</h2>
            <p>Employee password reset is secure and quick. Enter your email to continue.</p>
        </div>

        <!-- Form -->
        <div class="form-section">
            <h1>Reset Access</h1>
            <p>Provide your registered employee email address to get a reset link.</p>
            <form id="forgotForm" method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Enter your email" required />
                    <i class="fa fa-envelope"></i>
                </div>
                <button type="submit">Send Reset Link</button>
            </form>
            <a href="Login.php" class="back-link"><i class="fa fa-arrow-left"></i> Back to Employee Login</a>
        </div>
    </div>
</body>

</html>