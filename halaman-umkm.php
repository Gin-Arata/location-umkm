<?php
include "./koneksi.php";

$id = $_GET['id'];
$query = "SELECT * FROM umkm_tb WHERE id = $id";
$result = mysqli_query($koneksi, $query);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $row['nama_umkm'] ?> - Local Biz Navigator
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/halaman-umkm.css">
</head>

<body>
    <div id="halaman-umkm-content">
        <div class="sidebar">
            <div class="username">
                <img src="./img/profile-circle-svgrepo-com.svg" alt="profile photo" style="width: 15%;">
                <div class="username-text">
                    <?php
                    session_start();
                    if (!isset($_SESSION['id'])) {
                        ?>
                        <p><a href="./login.php">Login / Signup</a></p>
                        <?php
                    } else {
                        $id = $_SESSION['id'];
                        $query = "SELECT * FROM user_tb WHERE id_user = '$id'";
                        $result = mysqli_query($koneksi, $query);
                        $row_user = mysqli_fetch_assoc($result);
                        ?>
                        <p>
                            <?= $row_user['username_user'] ?>
                        </p>

                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="sidebar-content">
                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/home-4-svgrepo-com.svg" alt="home logo">
                        <a href="./index.php">Home</a>
                    </div>

                </div>
                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/maps-svgrepo-com.svg" alt="maps logo">
                        <a href="./maps.php">Maps</a>
                    </div>

                </div>

                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/paper-and-pen-svgrepo-com.svg" alt="UMKM logo"
                            style="width: 8%; margin-left: 5px;">
                        <a href="./input-umkm.php">Daftar UMKM</a>
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

        <div class="main-content-halaman">
            <div>
                <div class="halaman-umkm-img">
                    <img src="./img/umkm/<?= $row['gambar_umkm'] ?>" alt="foto umkm"
                        style="width: 30%; margin-top: 15px;">
                </div>

                <div id="setting-flex-umkm">
                    <div class="halaman-umkm-deskripsi">
                        <h1>
                            <?= $row['nama_umkm'] ?>
                        </h1>
                        <h2>Owner:
                            <?= $row['owner_umkm'] ?>
                        </h2>
                        <h3>Deskripsi:</h3>
                        <p>
                            <?= $row['deskripsi_umkm'] ?>
                        </p>
                        <h3>Alamat:</h3>
                        <p>
                            <?= $row['lokasi_umkm'] ?>
                        </p>
                        <h3>Kontak:</h3>
                        <p>
                            <?= $row['kontak_umkm'] ?>
                        </p>
                        <h3>Jenis UMKM:</h3>
                        <p>
                            <?= $row['jenis_umkm'] ?>
                        </p>
                        <p></p>
                        <!-- <p>Instagram: <?= $row['instagram_umkm'] ?></p>
                <p>Facebook: <?= $row['facebook_umkm'] ?></p> -->
                    </div>

                    <div class="halaman-umkm-maps">
                        <iframe
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBI62jNvjlmkx91TcFFjMCSkp7e_LZiyI4&q=<?= $row['latitude'] ?>,<?= $row['longitude'] ?>"
                            width="250px" height="250px" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>