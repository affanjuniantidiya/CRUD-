<?php 
include "config.php"; 

$id = $_GET['id'];
$data = mysqli_query($konek, "SELECT * FROM transaksi WHERE id=$id");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];

    $start = strtotime($mulai);
    $end = strtotime($selesai);
    $total = (($end - $start) / 3600) * 5000;

    mysqli_query($konek,"UPDATE transaksi SET
        nama_pelanggan='$nama',
        jam_mulai='$mulai',
        jam_selesai='$selesai',
        total='$total'
        WHERE id=$id");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Transaksi Warnet</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" value="<?= $d['nama_pelanggan']; ?>" required>
            </div>

            <div class="input-group">
                <label>Jam Mulai</label>
                <input type="time" name="mulai" value="<?= $d['jam_mulai']; ?>" required>
            </div>

            <div class="input-group">
                <label>Jam Selesai</label>
                <input type="time" name="selesai" value="<?= $d['jam_selesai']; ?>" required>
            </div>

            <button type="submit" name="update">Update</button>
            <a href="dashboard.php" class="btn-gray">Kembali</a>
        </form>
    </div>
</body>
</html>