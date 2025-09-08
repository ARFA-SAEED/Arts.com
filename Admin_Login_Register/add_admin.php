<?php
// AddAdmin.php
require_once "Connection.php";

// Admin data
$name = "Admin";
$email = "artsadmin@gmail.com";
$password = "Artsadmin1234";

// Hash password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if admin already exists
$check = $conn->prepare("SELECT * FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "⚠️ Admin already exists!";
} else {
    // Insert admin
    $stmt = $conn->prepare("INSERT INTO users (Username, Email, User_password, User_role) VALUES (?, ?, ?, ?)");
    $role = "Admin";
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "✅ Admin inserted successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>