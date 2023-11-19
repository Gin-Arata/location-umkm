<?php include "./koneksi.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Biz Navigator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/input-umkm.css">
    <link rel="stylesheet" href="./style/main.css">
</head>

<body>
    <div id="daftar-content">
        <div class="sidebar">
            <div class="username">
                <img src="./img/profile-circle-svgrepo-com.svg" alt="profile photo" style="width: 15%;">
                <div id="index-username" class="username-text">
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
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <a href="./profile-user.php?id=<?= $row['id_user'] ?>">
                            <?= $row['username_user'] ?>
                        </a>

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
                        <a href="#">Daftar UMKM</a>
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

        <div class="daftar-umkm-content">
            <div class="form-input-umkm">
                <?php
                if (!isset($_SESSION['id'])) {
                    ?>
                    <h1 style="margin-top: 10%;">Anda harus login terlebih dahulu</h1>
                    <?php
                } else {
                    ?>
                    <h2>Daftar UMKM</h2>
                    <form action="./proses-umkm.php" method="POST" enctype="multipart/form-data">
                        <label for="nama-umkm">Nama UMKM</label> <br>
                        <input class="input-umkm" type="text" size="64" name="nama-umkm"
                            placeholder="Contoh: Bambu Sejahtera"><br>

                        <label for="pemilik-umkm">Pemilik UMKM</label><br>
                        <input class="input-umkm" type="text" size="64" name="pemilik-umkm" placeholder="Contoh: Asep"><br>

                        <label for="no-hp-umkm">No. HP UMKM</label><br>
                        <input class="input-umkm" type="text" size="64" name="no-hp-umkm"
                            placeholder="Contoh: +6285215456783"><br>

                        <label for="jenis-umkm">Jenis UMKM</label><br>
                        <input class="input-umkm" type="text" size="64" name="jenis-umkm" placeholder="Contoh: Makanan"><br>

                        <label for="latitude-umkm">Latitude</label><br>
                        <input class="input-umkm" type="text" size="64" name="latitude" placeholder="Contoh: -7.946751"><br>

                        <label for="longitude-umkm">Longitude</label><br>
                        <input class="input-umkm" type="text" size="64" name="longitude"
                            placeholder="Contoh: 112.615951"><br>

                        <label for="detail-lokasi-umkm">Lokasi UMKM</label><br>
                        <textarea name="lokasi-umkm" placeholder="Contoh: Jl. Diguna-guna No. 27, Gedung Senyum Media Lt. 5"
                            rows="4" cols="79" maxlength="255"></textarea><br>

                        <label for="deskripsi-umkm">Deskripsi UMKM</label><br>
                        <textarea name="deskripsi-umkm"
                            placeholder="Contoh: Bambu sejahtera merupakan salah satu warung ternama di Malang. Karena murah"
                            rows="4" cols="79" maxlength="255"></textarea><br>

                        <label for="foto-umkm">Upload Bukti UMKM</label><br>
                        <input class="form-control" type="file" size="35" name="foto-umkm" id="foto-umkm"><br>
                        <button type="submit" name="aksi" value="tambah-umkm" class="btn btn-primary">
                            Tambahkan UMKM
                        </button>

                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>