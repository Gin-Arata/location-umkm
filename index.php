<?php include("./koneksi.php");
$queryJoin = "SELECT * FROM promosi_tb INNER JOIN umkm_tb ON promosi_tb.id_umkm = umkm_tb.id";
$sqlJoin = mysqli_query($koneksi, $queryJoin);
?>
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
    <link rel="stylesheet" href="./style/main.css">
</head>

<body>
    <div id="home-content">
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
                        <a href="#">Home</a>
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

        <div class="main-content">
            <div class="main-search">
                <form action="">
                    <input type="text" placeholder="Search..." name="search" class="input-search" id="search">
                </form>
            </div>

            <div class="promosi-carousel">
                <div class="carousel">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            while ($resultJoin = mysqli_fetch_assoc($sqlJoin)) {
                                if ($resultJoin['id_promosi'] == 1) { ?>
                                    <div class="carousel-item active">
                                        <a href="./halaman-umkm.php?id=<?= $resultJoin['id_umkm'] ?>"><img
                                                src="./img/umkm/<?= $resultJoin['gambar_umkm'] ?>" class="d-block w-100"
                                                alt="..."></a>
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>
                                                <?= $resultJoin['nama_umkm'] ?>
                                            </h5>
                                            <p>
                                                <?= $resultJoin['deskripsi_umkm'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                } else if ($resultJoin['id_promosi'] >= 2 && $resultJoin['id_promosi'] <= 5) {
                                    ?>
                                        <div class="carousel-item">
                                            <a href="./halaman-umkm.php?id=<?= $resultJoin['id_umkm'] ?>"><img
                                                    src="./img/umkm/<?= $resultJoin['gambar_umkm'] ?>" class="d-block w-100"
                                                    alt="...">
                                            </a>
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>
                                                <?= $resultJoin['nama_umkm'] ?>
                                                </h5>
                                                <p>
                                                <?= $resultJoin['deskripsi_umkm'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="main-content-umkm">
                <div class="rekomendasi-umkm">
                    <h3 id="text-h3" style="align-self: flex-start; margin-left: 5%;">Rekomendasi UMKM</h3>
                    <div id="result-search"></div>
                    <?php
                    $page = isset($_GET['page']) ? (int) $_GET["page"] : 1;
                    $perPage = 10;
                    $offset = ($page - 1) * $perPage;
                    $query = "SELECT * FROM umkm_tb  ORDER BY id DESC LIMIT $perPage OFFSET $offset";
                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <a href="./halaman-umkm.php?id=<?= $row['id']; ?>">
                            <div class="rekomendasi-umkm-content">
                                <div class="rekomendasi-umkm-content-img">
                                    <img src="./img/umkm/<?= $row['gambar_umkm']; ?>" alt="" style="width: 200px;">
                                </div>
                                <div class="rekomendasi-umkm-name">
                                    <h5>
                                        <?= $row['nama_umkm']; ?>
                                    </h5>
                                    <p>Owner:
                                        <?= $row['owner_umkm']; ?>
                                    </p>
                                    <p>Lokasi:
                                        <?= $row['lokasi_umkm'] ?>
                                    </p>
                                    <p>Deskripsi: </p>
                                    <p>
                                        <?= $row['deskripsi_umkm'] ?>
                                    </p>
                                </div>
                            </div>
                        </a>

                        <?php
                    }

                    ?>
                    <!-- echo '<a href="?page='. max(1, $page - 1) . '">Previous</a>';
                    echo '<a href="?page='. $page + 1 . '">Next</a>'; -->
                    <div class="next-prev-button">
                        <a href="?page=<?= max(1, $page - 1) ?>"><button class="button-page">Previous Page</button></a>
                        <a href="?page=<?= $page + 1 ?>"><button class="button-page" style="align-self: flex-end;">Next
                                Page</button></a>
                    </div>
                </div>
                <div class="promosi-umkm">
                    <h3 id="text-h3" style="align-self: flex-start;">Promosi UMKM</h3>
                    <?php
                    $queryMaxId = "SELECT MAX(id_promosi) as max_id FROM promosi_tb";
                    $sqlMaxId = mysqli_query($koneksi, $queryMaxId);
                    $resultMaxId = mysqli_fetch_assoc($sqlMaxId);

                    $randomId = rand(1, $resultMaxId['max_id']);

                    $queryTampil = "SELECT * FROM promosi_tb INNER JOIN umkm_tb ON promosi_tb.id_umkm = umkm_tb.id WHERE promosi_tb.id_promosi = '$randomId'";
                    $resultTampil = mysqli_query($koneksi, $queryTampil);
                    $rowTampil = mysqli_fetch_assoc($resultTampil);
                    ?>
                    <a href="./halaman-umkm.php?id=<?= $rowTampil['id'] ?>">
                        <div class="box-promosi">
                            <div class="box-promosi-content">
                                <div class="box-promosi-content-img">
                                    <img src="./img/umkm/<?= $rowTampil['gambar_umkm'] ?>" alt="Gambar UMKM"
                                        width="70%">
                                </div>
                                <div class="box-promosi-content-text">
                                    <h5>
                                        <?= $rowTampil['nama_umkm'] ?>
                                    </h5>
                                    <p>
                                        <?= $rowTampil['deskripsi_umkm'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>




    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Live Search AJAX -->
    <script>
        $(document).ready(function () {
            $("#search").on('keyup', function () {
                var search = $(this).val();
                $.ajax({
                    url: './search-umkm.php',
                    type: 'GET',
                    data: { search: search },
                    success: function (response) {

                        if (response) {
                            $("#text-h3").hide();
                            $(".rekomendasi-umkm-content").hide();
                            $("#result-search").html(response);
                        } else {
                            $(".rekomendasi-umkm-content").show();
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>