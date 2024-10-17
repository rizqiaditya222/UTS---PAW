<?php

session_start();
include "databaseLaptop.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlQuery = "SELECT * FROM spesifikasi_laptop WHERE ID_LAPTOP = $id";
    $result = $db->query($sqlQuery);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM spesifikasi_laptop WHERE ID_LAPTOP='$id'";
        if ($db->query($sqlDelete) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $db->error;
        }
    } else {
        echo "Item tidak ditemukan.";
        exit();
    }
}

?>