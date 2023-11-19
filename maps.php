<?php
include './koneksi.php';

$result = $koneksi->query("SELECT * FROM locations");

$locations = array();
while ($row = $result->fetch_assoc()) {
    $locations[] = array(
        'name' => $row['name'],
        'lat' => $row['latitude'],
        'lng' => $row['longitude']
    );
}

$locationsJson = json_encode($locations);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maps - Local Biz Navigator</title>

    <style>
        #mapCanvas {
            width: 100%;
            height: 650px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/maps.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMttT436KlHDce6534Wk2YYFN4dT_3MP4"></script>
    <script>
        var locations = <?php echo $locationsJson; ?>;

        function initMap() {
            var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                zoom: 10,
                center: new google.maps.LatLng(locations[0].lat, locations[0].lng),
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent('<h3>' + locations[i].name + '</h3>');
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }

        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
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
                        <a href="./index.php">Home</a>
                    </div>

                </div>
                <div class="sidebar-item">
                    <div class="sidebar-item-content">
                        <img src="./img/maps-svgrepo-com.svg" alt="maps logo">
                        <a href="#">Maps</a>
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

        <div class="maps-content">
            <h1>Local Biz Navigator Maps</h1>
            <div id="mapCanvas" style="width: 80%;"></div>
        </div>
    </div>

</body>

</html>