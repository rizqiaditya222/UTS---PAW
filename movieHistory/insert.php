<?php
session_start();
include "databaseLaptop.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $harga = $_POST['harga'];
    $ukuran = $_POST['ukuran'];
    $cpu = $_POST['cpu'];
    $gpu = $_POST['gpu'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $img_path = "";

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "picture/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 5000000) {
            echo "File terlalu besar.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $img_path = $target_file; 
            } else {
                echo "Terjadi kesalahan saat mengupload file.";
            }
        }
    }

    $sqlQuery = "INSERT INTO spesifikasi_laptop (MERK, MODEL, HARGA, UKURAN, CPU, GPU, RAM, STORAGE, IMG_PATH) 
                 VALUES ('$merk', '$model', '$harga', '$ukuran', '$cpu', '$gpu', '$ram', '$storage', '$img_path')";

    if ($db->query($sqlQuery)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $db->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Laptop</title>
</head>
<body>
    <h1>Insert Laptop</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="merk">Merk :</label><br>
        <input type="text" name="merk" required><br>

        <label for="model">Model :</label><br>
        <input type="text" name="model" required><br>

        <label for="harga">Harga :</label><br>
        <input type="number" name="harga" required><br>

        <label for="ukuran">Ukuran :</label><br>
        <input type="number" name="ukuran" required><br>

        <label for="cpu">CPU :</label><br>
        <input type="text" name="cpu" required><br>

        <label for="gpu">GPU :</label><br>
        <input type="text" name="gpu" required><br>

        <label for="ram">RAM :</label><br>
        <input type="text" name="ram" required><br>

        <label for="storage">Storage :</label><br>
        <input type="text" name="storage" required><br>

        <label for="image">Gambar :</label><br>
        <input type="file" name="image"><br><br>

        <input type="submit" value="Insert">
        <br><br>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
