<?php
include "config.php";

$id = $_GET['id'];
$d =
mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM transaksi WHERE id=$id"));
$pc_id = $d['pc_id'];

mysqli_query($konek,"DELETE FROM transaksi WHERE id=$id");

mysqli_query($konek,"UPDATE komputer SET status='kosong' WHERE id=$pc_id");

header("Location: index.php");
?>