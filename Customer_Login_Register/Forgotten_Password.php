<?php
session_start();
include('Connection.php'); // your database connection

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['id'];

        // Generate token
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Insert token into database
        $stmt2 = $conn->prepare("INSERT INTO password_resets (user_id, token, expiry) VALUES (?, ?, ?)");
        $stmt2->bind_param("iss", $user_id, $token, $expiry);
        $stmt2->execute();

        // Send email
        $reset_link = "http://yourdomain.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $body = "Hi,\n\nClick the link below to reset your password:\n$reset_link\n\nThis link expires in 1 hour.";
        $headers = "From: noreply@yourdomain.com";

        if (mail($email, $subject, $body, $headers)) {
            $message = "Reset link has been sent to your email.";
        } else {
            $message = "Failed to send email. Try again later.";
        }
    } else {
        $message = "Email not found in our records.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* --- Your CSS from the design --- */
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
            position: relative;
            overflow: hidden;
            background: linear-gradient(120deg, #ffe6ec, #fff0f7, #e6faff, #fdf3e6);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
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
            animation: fadeUp 0.6s ease;
            z-index: 5;
            position: relative;
        }

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
            animation: pulse 2.5s infinite ease-in-out;
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

        @keyframes fadeUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @media(max-width:768px) {
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

        @media(max-width:480px) {
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

        .message {
            color: #FF416C;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="illustration">
            <i class="fa fa-user-circle"></i>
            <h2>Forgot Password?</h2>
            <p>Don’t worry, customers! We’ll help you reset your password quickly.</p>
        </div>

        <div class="form-section">
            <h1>Reset Your Password</h1>
            <p>Enter your customer email address and we’ll send you a reset link.</p>
            <?php if ($message)
                echo "<div class='message'>$message</div>"; ?>
            <form id="forgotForm" method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Enter your email" required />
                    <i class="fa fa-envelope" style="color: #ff416c !important;"></i>
                </div>
                <button type="submit">Send Reset Link</button>
            </form>
            <a href="Login_Signup.php" class="back-link"><i class="fa fa-arrow-left"></i> Back to Customer Login</a>
        </div>
    </div>
</body>

</html>