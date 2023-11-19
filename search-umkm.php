<?php
include "./koneksi.php";

$keyword = $_GET['search'];
$query = "SELECT * FROM umkm_tb WHERE nama_umkm LIKE '%$keyword%' OR jenis_umkm LIKE '%$keyword%'";
$result = mysqli_query($koneksi, $query);


if (mysqli_num_rows($result) > 0) {
    ?>

    <h3 id="text-h3-hasil" style="align-self: flex-start; margin-left: 5%;">Hasil Search Anda: </h3>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {


        ?>

        <a href="./halaman-umkm.php?id=<?= $row['id']; ?>" style="width: 100%;">
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
<?php
} else {
    echo "<h1>UMKM tidak ditemukan</h1>";
}

?>