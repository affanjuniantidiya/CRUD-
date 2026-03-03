 <?php
session_start();
if(!isset($_SESSION['kasir'])){
    header("Location: login.php");
    exit;
}

include "config.php";
$data = mysqli_query($konek,"SELECT * FROM komputer");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Dashboard Kasir Warnet</h2>
    <div class="top-actions">
    <a href="index.php" class="btn">Kelola Transaksi</a>
    <a href="logout.php" class="btn-red">Logout</a>
</div>

    <h3>Status Komputer</h3>
    <div class="grid">
        <?php while($pc = mysqli_fetch_array($data)){ ?>
            <div class="pc-box <?= $pc['status'] ?>">
                PC <?= $pc['nomor_pc'] ?><br>
                <span><?= strtoupper($pc['status']) ?></span>
            </div>
            <?php } ?>
    </div>
</body>
</html>