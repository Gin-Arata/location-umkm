<?php
include "./koneksi.php";

$idUser = $_GET['id'];
$queryUmkm = "SELECT * FROM umkm_tb WHERE id_user = '$idUser'";

$resultUmkm = mysqli_query($koneksi, $queryUmkm);
$rowUmkm = mysqli_fetch_assoc($resultUmkm);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promosi - Local Biz Navigator</title>
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/promosi-umkm.css">
</head>

<body>
    <div id="promosi-umkm">
        <div class="sidebar">
            <div class="username">
                <img src="./img/back.png" alt="profile photo" style="width: 8%;">
                <div class="username-text">
                    <a href="./index.php">Back</a>
                </div>
            </div>

            <div class="sidebar-content">
                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/profile-circle-svgrepo-com.svg" alt="home logo">
                        <a href="./profile-user.php?id=<?= $_GET['id']; ?>">Change Profile</a>
                    </div>

                </div>
                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/promotion.png" alt="maps logo">
                        <a href="#">Promosikan UMKM</a>
                    </div>

                </div>

                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/session-leave-svgrepo-com.svg" alt="leave logo">
                        <a href="./proses-logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="promosi-umkm-content">
            <?php
            if ($rowUmkm['id'] == null) {
                echo "<h1>Anda belum memiliki UMKM</h1>";
            } else {
                ?>
                <div class="box-promosi">
                    <div class="box-promosi-header">
                        <h1>Promosikan UMKM Anda</h1>
                    </div>

                    <div class="box-promosi-body">
                        <img src="./img/umkm/<?= $rowUmkm['gambar_umkm'] ?>" alt="gambar UMKM" width="40%">
                        <h3 style="margin-top: 20px;" >Nama UMKM: <?= $rowUmkm['nama_umkm'] ?></h3>
                        <h3>Lokasi UMKM: <?= $rowUmkm['lokasi_umkm'] ?></h3>
                        <h3>Deskripsi UMKM: <?= $rowUmkm['deskripsi_umkm'] ?></h3>
                        <h3>Kontak UMKM: <?= $rowUmkm['kontak_umkm'] ?></h3>
                    </div>

                    <div class="box-promosi-button">
                        <form action="./proses-umkm.php" method="POST">
                            <input type="hidden" name="id" value="<?= $rowUmkm['id_user'] ?>" >
                            <button type="submit" name="aksi" value="promosi-umkm" >Promosikan UMKM</button>
                        </form>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>