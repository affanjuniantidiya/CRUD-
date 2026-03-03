<?php
session_start();
if(!isset($_SESSION['kasir'])) {
    header("Location: login.php");
    exit;
}

include "config.php";
$data = mysqli_query($konek,"SELECT t.*, k.nomor_pc FROM transaksi t JOIN komputer k ON t.pc_id=k.id ORDER BY t.id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>Data Transaksi</h2>

    <div class="top-actions">
        <a href="tambah.php" class="btn">+ Tambah Transaksi</a>
        <a href="dashboard.php" class="btn-gray">Kembali</a>
    </div>

    <div class="transaction-grid">
        <?php while($d = mysqli_fetch_array($data)){ ?>
        <div class="transaction-card">
            <div class="row"><span>Nama:</span> <?= $d['nama_pelanggan'] ?></div>
            <div class="row"><span>PC:</span> <span class="pc-badge">PC <?= $d['nomor_pc'] ?></span></div>
            <div class="row"><span>Durasi:</span> <?= $d['durasi'] ?> jam</div>
            <div class="row"><span>Mulai:</span> <?= $d['jam_mulai'] ?></div>
            <div class="row"><span>Selesai:</span> <?= $d['jam_selesai'] ?></div>
            <div class="total">Rp <?= number_format($d['total']) ?></div>
            <div class="actions">
                <a href="edit.php?id=<?= $d['id'] ?>">Edit</a> |
                <a onclick="return confirm('Hapus?')" href="hapus.php?id=<?= $d['id'] ?>">Hapus</a>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>