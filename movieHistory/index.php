<?php
session_start();
include "databaseLaptop.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy(); 
    header("Location: Login.php"); 
    exit();
}

$sqlQuery = "SELECT * FROM spesifikasi_laptop";
$result = $db->query($sqlQuery);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laptop</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        img {
            width: 100px;
            height: auto;
        }

    </style>
</head>
<body>
    <h1>Selamat datang, <?php echo $_SESSION['username']; ?></h1>

    <h2>Daftar Laptop yang Tersedia</h2>

    <table>
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Harga</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['MERK']; ?></td>
                <td><?php echo $row['MODEL']; ?></td>
                <td><?php echo $row['HARGA']; ?></td>
                <td>
                    <img src="<?php echo $row['IMG_PATH']; ?>" alt="Gambar Laptop">
                </td>
                <td>
                    <a href="detail.php?id=<?php echo $row['ID_LAPTOP']; ?>">Detail</a>
                </td>
                <td>
                    <a href="update.php?id=<?php echo $row['ID_LAPTOP']; ?>">update</a>
                </td>
                <td>
                    <a href="delete.php?id=<?php echo $row['ID_LAPTOP']; ?>">hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <form action="index.php" method="post">
        <br>
        <input type="submit" name="logout" value="Logout">
    </form>
    <br>
    <a href="insert.php">Tambahkan data</a>
</body>
</html>
