<?php
session_start();
include "config.php";

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $q = mysqli_query($konek,"SELECT * FROM kasir WHERE username='$user' AND password='$pass'");
    if(mysqli_num_rows($q) > 0){
        $_SESSION['kasir'] = $user;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Username/Password salah');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button name="login">Masuk</button>
        </form>
    </div>
</body>
</html>