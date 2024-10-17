<?php
    include "database.php";

    if (isset($_POST['Daftar'])) {  
        $nama = $_POST['nama'];
        $tanggalLahir = $_POST['Birthdate'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $checkUsername = "SELECT * FROM user_acc WHERE USERNAME = '$username'";
        $result = $db->query($checkUsername);
        
        if ($result->num_rows > 0) {
            echo "Username sudah ada, silakan pilih yang lain.";
        } else {
            $sqlQuery = "INSERT INTO user_acc (`NAMA`, `BIRTHDATE`, `USERNAME`, `PASSWORD`) VALUES ('$nama', '$tanggalLahir', '$username', '$password')";
            if ($db->query($sqlQuery)) {
                echo "Registrasi berhasil";
                // header ("Location: login.php");
            } else {
                echo "Registrasi gagal";
            }
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
    <form action="register.php" method="post">
        <input type="text" placeholder="Nama Lengkap" name="nama" required><br>
        <input type="text" placeholder="Tanggal Lahir (YYYY-MM-DD)" name="Birthdate" required><br>
        <input type="text" placeholder="Username" name="username" required><br>
        <input type="password" placeholder="Password" name="password" required><br>
        <input type="submit" name="Daftar" value="Daftar">
        <a href="login.php"><br>Sudah punya akun? Masuk di sini</a>
    </form>
</body>
</html>
