<?php
session_start();
include('./Connection.php'); // your DB connection file

if (isset($_POST['register'])) {
    $name = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $user_role = 'Customer';

    // Validation
    if (strlen($name) < 2 || strlen($password) < 6 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['alert_signup'] = [
            'type' => 'error',
            'message' => 'Invalid input. Please check your details.'
        ];
        header("Location: Login_Signup.php");
        exit();
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    if (!$stmt) {
        $_SESSION['alert_signup'] = [
            'type' => 'error',
            'message' => 'Database error: ' . $conn->error
        ];
        header("Location: Login_Signup.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['alert_signup'] = [
            'type' => 'error',
            'message' => 'Email is already registered. Please log in instead.'
        ];
        $stmt->close();
        header("Location: Login_Signup.php");
        exit();
    }
    $stmt->close();

    // Register new user
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    $insert_stmt = $conn->prepare("INSERT INTO users (Username, Email, User_password, User_role) VALUES (?, ?, ?, ?)");
    if (!$insert_stmt) {
        $_SESSION['alert_signup'] = [
            'type' => 'error',
            'message' => 'Database error: ' . $conn->error
        ];
        header("Location: Login_Signup.php");
        exit();
    }

    $insert_stmt->bind_param("ssss", $name, $email, $hashedpassword, $user_role);
    $exec_result = $insert_stmt->execute();

    if ($exec_result) {
        $_SESSION['alert_signup'] = [
            'type' => 'success',
            'message' => '🎉 Congratulations! You have successfully signed up to ARTS! ',
            'redirect' => '../Customer/index.php', // destination
            'delay' => 3000 // in milliseconds
        ];

        header("Location: Login_Signup.php");
        exit();
    } else {
        $_SESSION['alert_signup'] = [
            'type' => 'error',
            'message' => 'Registration failed: ' . $insert_stmt->error
        ];
        $insert_stmt->close();
        header("Location: Login_Signup.php");
        exit();
    }
}
?>