<?php
include "databaseLaptop.php";

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laptop</title>

    <style>
        img{
            width: 350px;
        }
    </style>
</head>
<body>
    <h1>Detail Laptop</h1>
    <img src="<?php echo $row['IMG_PATH']; ?>" alt="Gambar Laptop">
    <p>Brand: <?php echo $row['MERK']; ?></p>
    <p>Model: <?php echo $row['MODEL']; ?></p>
    <p>Ukuran Layar: <?php echo $row['UKURAN']; ?> INCH</p>
    <p>CPU: <?php echo $row['CPU']; ?></p>
    <p>GPU: <?php echo $row['GPU']; ?></p>
    <p>RAM: <?php echo $row['RAM']; ?></p>
    <p>STORAGE: <?php echo $row['STORAGE']; ?></p>

    <a href="index.php">Kembali</a>
</body>
</html>
