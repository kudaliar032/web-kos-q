<?
	if(isset($_POST['updateData'])) {
		$idid = $_GET['id'];	

		mysql_query("UPDATE dataKost SET nama='$_POST[nama]' WHERE id = $idid");
		mysql_query("UPDATE dataKost SET lat='$_POST[lat]' WHERE id = $idid");
		mysql_query("UPDATE dataKost SET long='$_POST[long]' WHERE id = $idid");
		mysql_query("UPDATE dataKost SET intro='$_POST[intro]' WHERE id = $idid");
		mysql_query("UPDATE dataKost SET harga='$_POST[harga]' WHERE id = $idid");
		
		mysql_query("UPDATE kapasitasKost SET kapasitas='$_POST[kapasitas]' WHERE id_kost = $idid");
	
		mysql_query("UPDATE kontakKost SET phone='$_POST[phone]' WHERE id = $idid");
		mysql_query("UPDATE kontakKost SET email='$_POST[email]' WHERE id = $idid");

		// update fasilitas kamar
        $kamar = $_POST['kamar'];
        $jmlhPilihan = count($kamar);
        mysql_query("DELETE FROM fasilitasKamar WHERE id = $idid");
        for($a=0; $a<$jmlhPilihan; $a++) {
            mysql_query("INSERT INTO fasilitasKamar VALUES ('','$idid','$kamar[$a]')");
        }		

        // update fasilitas kamar mandi
        $mandikan = $_POST['mandi'];
        $jmlhPilihan = count($mandikan);
        mysql_query("DELETE FROM fasilitasMandi WHERE id = $idid");
        for($a=0; $a<$jmlhPilihan; $a++) {
            mysql_query("INSERT INTO fasilitasMandi VALUES ('','$idid','$mandikan[$a]')");
        }

		mysql_query("UPDATE spesifikasiKost SET panjangKamar='$_POST[panjang]' WHERE id = $idid");
		mysql_query("UPDATE spesifikasiKost SET lebarKamar='$_POST[lebar]' WHERE id = $idid");
		mysql_query("UPDATE spesifikasiKost SET air='$_POST[air]' WHERE id = $idid");
		mysql_query("UPDATE spesifikasiKost SET listrik='$_POST[listrik]' WHERE id = $idid");
		mysql_query("UPDATE spesifikasiKost SET internet='$_POST[internet]' WHERE id = $idid");
		mysql_query("UPDATE spesifikasiKost SET malam='$_POST[malam]' WHERE id = $idid");
		mysql_query("UPDATE spesifikasiKost SET peraturan ='$_POST[peraturan]' WHERE id = $idid");

		echo "<script>alert('Data berhasil di update!!!')</script>";
	}
?>