<?php
session_start();
include('./Connection.php');

// Handle form submission
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // Check if email exists
    $query = "SELECT * FROM users WHERE Email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Generate unique token & expiration
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // Save token to DB
        $updateQuery = "UPDATE users SET password_reset_token='$token', password_reset_expiration='$expires' WHERE Email='$email'";
        mysqli_query($conn, $updateQuery);

        // Reset link
        $resetLink = "https://yourdomain.com/ResetPassword.php?token=$token";

        // Email content
        $subject = "Password Reset Request";
        $message = "Hi " . $user['Username'] . ",\n\nWe received a request to reset your password.\n";
        $message .= "Click the link below to reset your password:\n$resetLink\n\n";
        $message .= "If you did not request this, ignore this email.\n";
        $headers = "From: noreply@yourdomain.com\r\n";

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['message'] = "A password reset link has been sent to your email.";
        } else {
            $_SESSION['message'] = "Failed to send reset email. Try again later.";
        }

    } else {
        $_SESSION['message'] = "No account found with that email.";
    }

    header("Location: ForgotPassword.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            width: 400px;
            max-width: 90%;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
        }

        h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 15px;
            margin: 8px 0;
            border-radius: 10px;
            border: none;
            background: #f0ebeb;
            font-size: 14px;
        }

        button {
            background: #FF4B2B;
            border: 1px solid #FF4B2B;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            padding: 12px 45px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            letter-spacing: 1px;
            margin-top: 10px;
            transition: transform 0.2s;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        a {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #FF416C;
            font-size: 14px;
        }

        .error-message {
            color: orange;
            font-size: 12px;
            text-align: left;
            margin-bottom: 5px;
        }

        #successAlert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #4CAF50;
            color: #fff;
            padding: 15px 25px;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION['message'])) {
        echo "<div id='successAlert'>" . $_SESSION['message'] . "</div>";
        echo "<script>
        setTimeout(() => { 
            const alertBox = document.getElementById('successAlert');
            if (alertBox) alertBox.style.display = 'none';
        }, 5000);
    </script>";
        unset($_SESSION['message']);
    }
    ?>

    <div class="container">
        <h1>Forgot Password?</h1>
        <p>Enter your email below to receive a password reset link.</p>
        <form id="forgotForm" method="POST">
            <input type="email" name="email" placeholder="Email" required />
            <small class="error-message"></small>
            <button type="submit">Send Reset Link</button>
        </form>
        <a href="Login_Signup.php">Back to Login</a>
    </div>

    <script>
        document.getElementById("forgotForm").addEventListener("submit", function (e) {
            const email = this.email.value.trim();
            const error = this.email.nextElementSibling;
            error.textContent = "";
            const pattern = /^\S+@\S+\.\S+$/;
            if (!pattern.test(email)) {
                e.preventDefault();
                error.textContent = "Please enter a valid email address.";
            }
        });
    </script>
</body>

</html>