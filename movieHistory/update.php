<?php
session_start();
include "databaseLaptop.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlQuery = "SELECT * FROM spesifikasi_laptop WHERE ID_LAPTOP = $id";
    $result = $db->query($sqlQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 
    } else {
        echo "Item tidak ditemukan.";
        exit();
    }
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

    $img_path = $row['IMG_PATH'];
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

    $sqlUpdate = "UPDATE spesifikasi_laptop SET 
                  MERK = '$merk', 
                  MODEL = '$model', 
                  HARGA = '$harga',
                  UKURAN = '$ukuran',
                  CPU = '$cpu',
                  GPU = '$gpu',
                  RAM = '$ram',
                  STORAGE = '$storage',
                  IMG_PATH = '$img_path'
                  WHERE ID_LAPTOP = $id";

    if ($db->query($sqlUpdate) === TRUE) {
        echo "Data berhasil diupdate.";
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
    <title>Update Laptop</title>
</head>
<body>
    <h1>Update Laptop</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="merk">Merk :</label><br>
        <input type="text" name="merk" value="<?php echo $row['MERK']; ?>" required><br>

        <label for="model">Model :</label><br>
        <input type="text" name="model" value="<?php echo $row['MODEL']; ?>" required><br>

        <label for="harga">Harga :</label><br>
        <input type="number" name="harga" value="<?php echo $row['HARGA']; ?>" required><br>

        <label for="ukuran">Ukuran :</label><br>
        <input type="number" name="ukuran" value="<?php echo $row['UKURAN']; ?>" required><br>

        <label for="cpu">CPU :</label><br>
        <input type="text" name="cpu" value="<?php echo $row['CPU']; ?>" required><br>

        <label for="gpu">GPU :</label><br>
        <input type="text" name="gpu" value="<?php echo $row['GPU']; ?>" required><br>

        <label for="ram">RAM :</label><br>
        <input type="text" name="ram" value="<?php echo $row['RAM']; ?>" required><br>

        <label for="storage">Storage :</label><br>
        <input type="text" name="storage" value="<?php echo $row['STORAGE']; ?>" required><br>

        <label for="image">Gambar :</label><br>
        <input type="file" name="image"><br>
        <img src="<?php echo $row['IMG_PATH']; ?>" alt="Gambar Laptop" width="150"><br><br>

        <input type="submit" value="Update">
        <br>
        <br>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
