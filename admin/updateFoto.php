<?php
    $sql1 = mysql_query("SELECT * FROM fotoKost WHERE id = '$_GET[id]'");
    $gh = mysql_fetch_array($sql1);

    if(isset($_POST['updateKT'])) {
        $updateFoto = $gh['fotoKT'];

        if($_FILES['fotoKT']['name'] != null && $updateFoto != "img/default_profile.png") {
            move_uploaded_file($_FILES['fotoKT']['tmp_name'], "../".$updateFoto);
            unset($_POS);
           echo "<script>location.href='?page=foto&id=" . $_GET['id'] . "'</script>";
        } elseif($updateFoto == "img/default_profile.png" && $_FILES['fotoKT']['name'] != null) {
            $updateFoto = "fotoKost/profile_" . $_GET['id'] . ".jpg" ;
            mysql_query("UPDATE fotoKost SET fotoKT='$updateFoto' WHERE id=$_GET[id]");
            move_uploaded_file($_FILES['fotoKT']['tmp_name'], "../".$updateFoto);
            unset($_POS);
            echo "<script>location.href='?page=foto&id=" . $_GET['id'] . "'</script>";
        } else {
            echo "<script>alert('FILE TIDAK BOLEH KOSONG!')</script>";
        } 
    }    
    if(isset($_POST['updateKM'])) {
        $updateFoto = $gh['fotoKM'];

        if($_FILES['fotoKM']['name'] != null && $updateFoto != "img/default_header.jpg") {
            move_uploaded_file($_FILES['fotoKM']['tmp_name'], "../".$updateFoto);
            unset($_POS);
            echo "<script>location.href='?page=foto&id=" . $_GET['id'] . "'</script>";
        } elseif($updateFoto == "img/default_header.jpg" && $_FILES['fotoKM']['name'] != null) {
            $updateFoto = "fotoKost/header_" . $_GET['id'] . ".jpg" ;
            mysql_query("UPDATE fotoKost SET fotoKM='$updateFoto' WHERE id=$_GET[id]");
            move_uploaded_file($_FILES['fotoKM']['tmp_name'], "../".$updateFoto);
            unset($_POS);
            echo "<script>location.href='?page=foto&id=" . $_GET['id'] . "'</script>";
        } else {
            echo "<script>alert('FILE TIDAK BOLEH KOSONG!')</script>";
        } 
    }
?>