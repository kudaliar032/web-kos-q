<?php
    session_start();

    if(!isset($_SESSION['usradmin']) && !isset($_SESSION['pswadmin'])) {
        echo "<script>location.href='login.php'</script>";
    }
    
    include "../config.php";
    include "updateData.php";
    if(!isset($_GET['page']) || $_GET['page'] == "home") {
        $namaHalaman = "KOST-QU MYADMIN";
    } elseif($_GET['page'] == "edit") {
        $namaHalaman = "EDIT KOST";
    } elseif($_GET['page'] == "daftar") {
        $namaHalaman = "DAFTAR KOST";
    } elseif($_GET['page'] == "tambah") {
        $namaHalaman = "TAMBAH KOST";
    } elseif($_GET['page'] == "userAdmin") {
        $namaHalaman = "MANAJEMEN USER ADMIN";
    } elseif($_GET['page'] == "foto") {
        $namaHalaman = "MANAJEMEN FOTO KOST";
    } elseif($_GET['page'] == "userBiasa") {
        $namaHalaman = "MANAJEMEN USER BIASA";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?=$namaHalaman?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            html,body,h1,h2,h3,h4,h5 {
                font-family: "Raleway", sans-serif;
            }
            #map {
                height: 400px;
            }
            html, body {
                height: 100%;
            }
        </style>
    </head>
<body class="w3-white">
<div class="w3-hide-small">
    <!-- Top container -->
    <div class="w3-bar w3-top w3-teal w3-xlarge" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
        <span class="w3-bar-item w3-left">KOST-QU MYADMIN</span>
        <a href="logout.php" class="w3-bar-item w3-right w3-hover-black">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
    </div>
    <div class="w3-bar w3-teal w3-xlarge" style="z-index:4">
        <span class="w3-bar-item w3-left">KOST-QU MYADMIN</span>
    </div>

    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-teal" style="z-index:3;width:300px;" id="mySidebar"><br>
        <div class="w3-container w3-center">
            <img src="../img/admin.ico" class="w3-image w3-circle w3-white" style="width: 100px" />
            <div class="w3-row-padding w3-margin-top w3-margin-bottom">
                    <button onclick="window.open('../index.php', '_SELF')" class="w3-button w3-yellow w3-black">KOS-Q.INFO</button>
            </div>
        </div>
        <div class="w3-bar-block">
            <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
            <a href="?page=home" class="w3-bar-item w3-hover-white w3-button w3-padding <? if($_GET['page'] == "home") echo "w3-black" ?>"><i class="fa fa-home fa-fw"></i>  Home</a>
            <a href="?page=tambah" class="w3-bar-item w3-hover-white w3-button w3-padding <? if($_GET['page'] == "tambah") echo "w3-black" ?>"><i class="fa fa-plus fa-fw"></i>  Tambah Kost</a>
            <a href="?page=daftar" class="w3-bar-item w3-hover-white w3-button w3-padding <? if($_GET['page'] == "daftar" || $_GET['page'] == "edit" || $_GET['page'] == "foto") echo "w3-black" ?>"><i class="fa fa-wrench fa-fw"></i>  Manajemen Kost</a>
            <a href="?page=userAdmin" class="w3-bar-item w3-hover-white w3-button w3-padding <? if($_GET['page'] == "userAdmin") echo "w3-black" ?>"><i class="fa fa-users fa-fw"></i>  Manajemen User Admin</a>
            <a href="?page=userBiasa" class="w3-bar-item w3-hover-white w3-button w3-padding <? if($_GET['page'] == "userBiasa") echo "w3-black" ?>"><i class="fa fa-users fa-fw"></i>  Manajemen User Biasa</a>
        </div>
    </nav>


    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <!-- sidebar menu selesi -->

    <!-- isi inya -->
    <div class="w3-main" style="margin-left:300px;">
        <?php
            //echo $_SESSION['wktadmin'];

            if (!isset($_GET['page'])) {
                include "home.php";
            } elseif($_GET['page'] == "tambah") {
                include "tambah.php";
            } elseif($_GET['page'] == "daftar") {
                include "daftar.php";
            } elseif($_GET['page'] == "home") {
                include "home.php";
            } elseif($_GET['page'] == "edit") {
                include "edit.php";
            } elseif($_GET['page'] == "userAdmin") {
                include "userAdmin.php";
            } elseif($_GET['page'] == "foto") {
                include "foto.php";
            } elseif($_GET['page'] == "userBiasa") {
                include "userBiasa.php";
            }
        ?>
    </div>
    <!-- isi sampai sini -->
    
    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Get the DIV with overlay effect
        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
                overlayBg.style.display = "none";
            } else {
                mySidebar.style.display = 'block';
                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
            overlayBg.style.display = "none";
        }
    </script>
</div>

<div class="w3-hide-large w3-hide-medium w3-display-container" style="height: 100%">
    <div class="w3-display-middle w3-center">
        <div class="w3-xxlarge w3-center w3-margin">
            MOHON MAAF, HALAMAN ADMIN TIDAK SUPPORT UNTUK PONSEL/SMARTPHONE!!!
        </div>
        <button onclick="location.href='../index.php'" class="w3-button w3-xlarge w3-padding w3-green w3-hover-light-grey">HOME</button>
    </div>
</div>

</body>
</html>

