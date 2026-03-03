<?php
session_start();
if(!isset($_SESSION['kasir'])) {
    header("Location: login.php");
    exit;
}

include "config.php";

$pc = mysqli_query($konek,"SELECT * FROM komputer WHERE status='kosong'");

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $pc_id = $_POST['pc'];
    $durasi = $_POST['durasi'];

    $mulai = date("Y-m-d H:i:s");
    $selesai = date("Y-m-d H:i:s", strtotime("+$durasi hours"));

    $total = $durasi * 5000;

    mysqli_query($konek,"INSERT INTO transaksi VALUES(
        '',
        '$nama','$pc_id','$durasi',
        '$mulai','$selesai','$total'
    )");

    mysqli_query($konek,"UPDATE komputer SET status='terisi' WHERE id=$pc_id");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="tambah.css">
</head>
<body>
    <div class="form-container">
        <h2>Tambah Transaksi</h2>
        <form method="POST">
            <div class="input-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" required>
            </div>

            <div class="input-group">
                <label>Pilih Komputer (kosong)</label>
                <select name="pc" required>
                    <?php while($p = mysqli_fetch_array($pc)){ ?>
                        <option value="<?= $p['id'] ?>">PC <?= $p['nomor_pc'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-group">
                <label>Durasi (jam)</label>
                <input type="number" name="durasi" min="1" value="1" required>
            </div>

            <button name="simpan">Simpan</button>
        </form>
    </div>
</body>
</html>