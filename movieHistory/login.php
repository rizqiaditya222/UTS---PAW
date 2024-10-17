<?php
    include "database.php";
    session_start();

    if (isset($_SESSION['username'])) {
        header("Location: index.php"); 
        exit();
    }


    if (isset($_POST['Masuk'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];



        $sqlQuery = "SELECT  * FROM user_acc where USERNAME = '$username' AND PASSWORD = '$password'";
        $result = $db->query($sqlQuery);
        if ($result->num_rows > 0) {
            // echo "Berhasil Masuk";
            $_SESSION['username'] = $username; 
            header ("Location: index.php");
            exit();
        } else {
            echo "Username atau Password Salah!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<form action="login.php" method="post">
        <input type="text" placeholder="Username" name="username" required><br>
        <input type="password" placeholder="Password" name="password" required><br>
        <input type="submit" value="Masuk" name="Masuk">
    </form>

    <a href="register.php">Belum punya akun? Daftar di sini</a>
</body>
</html>