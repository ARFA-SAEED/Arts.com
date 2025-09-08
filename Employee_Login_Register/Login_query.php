<?php
session_start();
include 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['User_password'])) {
            // Store user info in session
            $_SESSION['user_id'] = $user['User_id'];
            $_SESSION['user_name'] = $user['Username'];
            $_SESSION['user_role'] = $user['user_role'];

            // Set alert and redirect
            $_SESSION['alert_login'] = [
                'type' => 'success',
                'message' => 'Welcome Back To ARTS Dashboard!',
                'redirect' => '../Admin/Dashboard.php' // <-- updated redirect
            ];
        } else {
            $_SESSION['alert_login'] = [
                'type' => 'error',
                'message' => 'Incorrect password!',
                'redirect' => 'Login_Register.php'
            ];
        }
    } else {
        $_SESSION['alert_login'] = [
            'type' => 'error',
            'message' => 'Email not registered!',
            'redirect' => 'Login_Register.php'
        ];
    }
    header("Location: Login_Register.php");
    exit;
}
?>