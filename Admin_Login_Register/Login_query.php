<?php
session_start();
require_once "Connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['User_password'])) {
            // ✅ Success
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['username'] = $user['username'];

            $_SESSION['alert_login'] = [
                "type" => "success",
                "message" => "Welcome Back To ARTS!",
                "redirect" => true
            ];
        } else {
            // ❌ Wrong password
            $_SESSION['alert_login'] = [
                "type" => "error",
                "message" => "Invalid password, try again.",
                "redirect" => false
            ];
        }
    } else {
        // ❌ No user found
        $_SESSION['alert_login'] = [
            "type" => "error",
            "message" => "No account found with this email.",
            "redirect" => false
        ];
    }

    $stmt->close();
    $conn->close();

    // ✅ Always go back to login.php so alert shows
    header("Location: Login.php");
    exit;
}
?>