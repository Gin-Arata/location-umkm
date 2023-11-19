<?php
include "koneksi.php";

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'login') {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $query = "SELECT * FROM user_tb WHERE email_user = '$email' AND password_user = '$password'";
        $sql = mysqli_query($koneksi, $query);

        if(mysqli_num_rows($sql) != 0) {
            $row = mysqli_fetch_assoc($sql);

            session_start();
            $_SESSION['id'] = $row['id_user'];
            header("location: ./index.php");
        } else {
            header("location: ./login.php");
        }
    } else if($_POST['aksi'] == 'signup') {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $kontak = $_POST['kontak'];

        $query = "INSERT INTO user_tb (email_user, username_user, password_user, kontak_user) VALUES ('$email', '$username', '$password', '$kontak')";
        $result = mysqli_query($koneksi, $query);

        header("location: ./login.php");
    } else if($_POST['aksi'] == 'update-user') {
        session_start();
        $idUser = $_SESSION['id'];
        $newUsername = $_POST['new_uname'];
        $newPass = md5($_POST['new_pass']);

        $query = 'UPDATE user_tb SET username_user = "'.$newUsername.'", password_user = "'.$newPass.'" WHERE id_user = "'.$idUser.'"';
        $result = mysqli_query($koneksi, $query);
        header('location: ./profile-user.php?id='.$idUser);
    }

}



?>