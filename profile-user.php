<?php
include "./koneksi.php";

$id = $_GET['id'];
$query = "SELECT * FROM umkm_tb AS u INNER JOIN user_tb AS us ON u.id_user = us.id_user WHERE u.id_user = '$id'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Local Biz Navigator</title>
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/profile-user.css">
</head>

<body>
    <div class="profile-content">
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
                        <a href="#">Change Profile</a>
                    </div>

                </div>
                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/promotion.png" alt="maps logo">
                        <a href="./promosi-umkm.php?id=<?= $row['id_user']; ?>">Promosikan UMKM</a>
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

        <div class="profile-content-user">
            <div>
                <div class="username-profile">
                    <img src="./img/profile-circle-svgrepo-com.svg" alt="profile img" width="6%">
                    <h3>Howdy,
                        <?= $row['username_user'] ?>
                    </h3>
                </div>

                <div class="profile-content-change">
                    <form action="./proses-user.php" method="POST">
                        <h4>Change Username</h4>
                        <input type="text" value="<?= $row['username_user']; ?>" name="new_uname">
                        <h4>Change Password</h4>
                        <input type="password" name="new_pass"> <br>
                        <button type="submit" name="aksi" value="update-user">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>