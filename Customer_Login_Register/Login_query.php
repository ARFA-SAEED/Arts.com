<?php
session_start();
include('./Connection.php'); // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        $_SESSION['alert_login'] = [
            'type' => 'error',
            'message' => '❌ Invalid email or password format.'
        ];
        header("Location: Login_Signup.php");
        exit();
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['User_password'])) {
            // Login success → create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['User_role'];

            $_SESSION['alert_login'] = [
                'type' => 'success',
                'message' => ' Welcome back to Arts, ' . htmlspecialchars($user['Username']) . '!',
                'redirect' => true
            ];

            header("Location: Login_Signup.php"); // Go back to show alert then redirect
            exit();
        } else {
            $_SESSION['alert_login'] = [
                'type' => 'error',
                'message' => '❌ Incorrect password.'
            ];
            header("Location: Login_Signup.php");
            exit();
        }
    } else {
        $_SESSION['alert_login'] = [
            'type' => 'error',
            'message' => '⚠️ No account found with this email..Signup instead!'
        ];
        header("Location: Login_Signup.php");
        exit();
    }
}
?>