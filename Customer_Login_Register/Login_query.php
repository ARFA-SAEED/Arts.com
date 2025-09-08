<?php
session_start();
include('./Connection.php'); // your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        $_SESSION['error'] = 'Invalid email or password format.';
        header("Location: Login_Signup.php");
        exit();
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    if (!$stmt) {
        $_SESSION['error'] = 'Database error: ' . $conn->error;
        header("Location: Login_Signup.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['User_password'])) {
            // ✅ Save session and alert message
            $_SESSION['user_id'] = $user['User_id'];
            $_SESSION['user_role'] = $user['User_role'];
            $_SESSION['username'] = $user['Username'];

            $_SESSION['alert_login'] = [
                'type' => 'success',
                'message' => '🎉 Congratulations! You have successfully Logged in to ARTS.',
                'redirect' => true
            ];

            // ⬇️ send them back to Login_Signup.php first
            header("Location: Login_Signup.php");
            exit();
        } else {
            $_SESSION['error'] = 'Incorrect password.';
            header("Location: Login_Signup.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Email not found.';
        header("Location: Login_Signup.php");
        exit();
    }
}
?>