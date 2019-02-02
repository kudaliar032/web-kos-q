<?php
    if(isset($_POST['simpan'])) {
        // mendapatkan id dari data yang ditambahkan
        $ambilID = mysql_query("SELECT MAX(id) FROM dataKost");
        $x = mysql_fetch_array($ambilID);
        if ($x == null) {
            $id = 1;
        } else {
            $id = $x['MAX(id)']+1;
        }
        
        // menangani upload foto
        // upload foto kamarkost, kamarmandi, ruangtamu
        $target_dir = "fotoKost/";

        // upload foto profile
        $fotoProfile = explode(".", $_FILES["fotoProfile"]["name"]);
        $formatProfile = end($fotoProfile);
        $fotoProfile = "profile_" . $id . '.' . $formatProfile;
        $simpanProfile = $target_dir . $fotoProfile;
        if ($formatProfile == "") {
            $simpanProfile = "img/default_profile.png";
        } else {
            move_uploaded_file($_FILES["fotoProfile"]["tmp_name"], "../".$simpanProfile);
        }

        // upload foto header
        $fotoHeader = explode(".", $_FILES["fotoHeader"]["name"]);
        $formatHeader = end($fotoHeader);
        $fotoHeader = "header_" . $id . '.' . $formatHeader;
        $simpanHeader = $target_dir . $fotoHeader;
        if ($formatHeader == "") {
            $simpanHeader = "img/default_header.jpg";
        } else {
            move_uploaded_file($_FILES["fotoHeader"]["tmp_name"], "../".$simpanHeader);
        }

        mysql_query("INSERT INTO fotoKost VALUES ('$id','$simpanProfile','$simpanHeader')");
        // upload foto selesai
        
        // set nilai jika kosong
        if(empty($_POST['kamar'])) {
            $_POST['kamar'] = array("kasur","lemari","meja","kursi");
        }
        if(empty($_POST['mandi'])) {
            $_POST['mandi'] = array("hangat");
        }
        if(empty($_POST['air'])) {
            $_POST['air'] = "Termasuk biaya kost";
        }
        if(empty($_POST['listrik'])) {
            $_POST['listrik'] = "Termasuk biaya kost";
        }
        if(empty($_POST['internet'])) {
            $_POST['internet'] = "Termasuk biaya kost";
        }
        if(empty($_POST['malam'])) {
            $_POST['malam'] = "22:00";
        }
        if(empty($_POST['panjang'])) {
            $_POST['panjang'] = 3;
        }
        if(empty($_POST['lebar'])) {
            $_POST['lebar'] = 3;
        }
        if(empty($_POST['peraturan'])) {
            $_POST['peraturan'] = "-";
        }
        if(empty($_POST['phone'])) {
            $_POST['phone'] = "081234567890";
        }
        if(empty($_POST['email'])) {
            $_POST['email'] = "admin@email.com";
        }
        if(empty($_POST['kapasitas'])) {
            $_POST['kapasitas'] = 1;
        }
        if(empty($_POST['harga'])) {
            $_POST['harga'] = 350000;
        }
        if(empty($_POST['intro'])) {
            $_POST['intro'] = "-";
        }
        // mengatur nilai jika kosong sampai sini

        // kumpulan query masukan database
        // campuran
        mysql_query("INSERT INTO dataKost VALUES ('$id','$_POST[nama]','$_POST[lat]','$_POST[long]','$_POST[intro]','$_POST[harga]')");
        mysql_query("INSERT INTO ratingKost VALUES ('$id','3','4','5')");
        mysql_query("INSERT INTO kapasitasKost VALUES ('$id','$_POST[kapasitas]')");
        mysql_query("INSERT INTO kontakKost VALUES ('$id','$_POST[phone]','$_POST[email]')");
        mysql_query("INSERT INTO spesifikasiKost VALUES ('$id','$_POST[panjang]','$_POST[lebar]','$_POST[air]','$_POST[listrik]','$_POST[internet]','$_POST[malam]','$_POST[peraturan]')");
        
        // save fasilitas kamar
        $kamar = $_POST['kamar'];
        $jmlhPilihan = count($kamar);
        for($a=0; $a<$jmlhPilihan; $a++) {
            mysql_query("INSERT INTO fasilitasKamar VALUES ('','$id','$kamar[$a]')");
        }

        // save fasilitas kamar mandi
        $mandi = $_POST['mandi'];
        $jmlhPilihan = count($mandi);
        for($a=0; $a<$jmlhPilihan; $a++) {
            mysql_query("INSERT INTO fasilitasMandi VALUES ('','$id','$mandi[$a]')");
        }
        // query masukan data sampai sini
        mysql_close();

        echo "<script>
                alert('DATA BERHASIL DITAMBAHKAN!');
              </script>";
    }
?>