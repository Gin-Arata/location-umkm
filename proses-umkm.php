<?php
    include "./koneksi.php";

    if(isset($_POST['aksi'])) {
        if($_POST['aksi'] == "tambah-umkm") {
            $nama_umkm = htmlspecialchars($_POST['nama-umkm']);
            $pemilik_umkm = htmlspecialchars($_POST['pemilik-umkm']); 
            $kontak_umkm = htmlspecialchars($_POST['no-hp-umkm']);
            $jenis_umkm = htmlspecialchars($_POST['jenis-umkm']);
            $latitude_umkm = htmlspecialchars($_POST['latitude']);
            $longitude_umkm = htmlspecialchars($_POST['longitude']);
            $lokasi_umkm = htmlspecialchars($_POST['lokasi-umkm']);
            $deskripsi_umkm = htmlspecialchars($_POST['deskripsi-umkm']);
            $id_user = $_SESSION['id'];
            $foto_umkm = $_FILES['foto-umkm']['name'];

            // move tmp to img/umkm
            $dir = "./img/umkm/";
            $tmpFile = $_FILES['foto-umkm']['tmp_name'];
            move_uploaded_file($tmpFile, $dir.$foto_umkm);

            $query = "INSERT INTO umkm_tb(id, nama_umkm, owner_umkm, lokasi_umkm, deskripsi_umkm, jenis_umkm, kontak_umkm, gambar_umkm, latitude, longitude, id_user) VALUES(null, '$nama_umkm', '$pemilik_umkm', '$lokasi_umkm', '$deskripsi_umkm', '$jenis_umkm', '$kontak_umkm', '$foto_umkm', '$latitude_umkm', '$longitude_umkm', '$id_user')";

            $query2 = "INSERT INTO locations(name, latitude, longitude) VALUES('$nama_umkm', '$latitude_umkm', '$longitude_umkm')";

            $sql = mysqli_query($koneksi, $query);
            $sql2 = mysqli_query($koneksi, $query2);

            if($sql) {
                header("Location: ./index.php");
            } else {
                
            } 
        } else if($_POST['aksi'] == "promosi-umkm") {
            $idUser = $_POST['id'];
            
            $queryJoin = "SELECT * FROM umkm_tb WHERE id_user = '$idUser'";
            $sqlJoin = mysqli_query($koneksi, $queryJoin);
            $resultJoin = mysqli_fetch_assoc($sqlJoin);

            $queryPromosi = "INSERT INTO promosi_tb(id_promosi, id_user, id_umkm) VALUES('', '$idUser', '$resultJoin[id]')";
            $sqlPromosi = mysqli_query($koneksi, $queryPromosi);

            if($sqlPromosi) {
                header("Location: ./promosi-umkm.php?id=$idUser");
            } else {
                echo "Gagal";
            }
        }
    }
?>