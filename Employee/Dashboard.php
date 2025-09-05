<?php
session_start();

if (isset($_SESSION['message'])) {
    echo "<div style='
        background: #d4edda;
        color: #155724;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        text-align: center;'>
        " . $_SESSION['message'] . "
    </div>";

    unset($_SESSION['message']); // clear message after showing
}
?>
<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    Hi My name is <?php echo $_SESSION['username'] ?>

    <img src="../Login_register/user_image/<?php echo $_SESSION['image'] ?>" height="200" alt="">

</body>

</html>