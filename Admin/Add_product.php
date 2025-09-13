<?php
session_start();
include 'Connection.php';

// Only Admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    die("<h2 style='color:red; text-align:center;'>Access denied! Only Admin can view this page.</h2>");
}

// Handle form submission
$message = '';
if (isset($_POST['add_employee'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'employee';

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $message = "Email already exists!";
    } else {
        // Insert employee into DB
        $sql = "INSERT INTO users (name, email, password, role) 
                VALUES ('$name', '$email', '$password', '$role')";

        if ($conn->query($sql)) {
            $message = "Employee added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee | Arts</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #8B0000;
            /* dark red background */
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #B22222;
            /* slightly lighter dark red */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        h2 {
            text-align: center;
            color: rgb(231, 200, 154);
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        form input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: rgb(231, 200, 154);
            color: #8B0000;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #FFDAB9;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Add Employee</h2>

        <?php
        if ($message != '') {
            echo "<div class='message'>$message</div>";
        }
        ?>

        <form action="" method="POST">
            <label>Name</label>
            <input type="text" name="name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="add_employee">Add Employee</button>
        </form>
    </div>

</body>

</html>