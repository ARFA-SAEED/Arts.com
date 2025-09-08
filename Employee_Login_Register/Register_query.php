<?php
session_start();
include 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT User_id FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['alert_login'] = [
            'type' => 'error',
            'message' => 'Email already registered!',
            'redirect' => 'Login_Register.php'
        ];
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $role = 'Employee';
        $stmt = $conn->prepare("INSERT INTO users (Username, Email, User_password, user_role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $_SESSION['alert_login'] = [
                'type' => 'success',
                'message' => 'Congratulations!You have logged in successfully.',
                'redirect' => '../Admin/Dashboard.php'  // <-- updated redirect
            ];
            $_SESSION['user_id'] = $stmt->insert_id; // optional: store user ID in session
            $_SESSION['user_name'] = $username;
            $_SESSION['user_role'] = $role;
        } else {
            $_SESSION['alert_login'] = [
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'redirect' => 'Login_Register.php'
            ];
        }
    }
    header("Location: Login_Register.php");
    exit;
}
?>