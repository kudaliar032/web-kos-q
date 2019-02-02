<?php
	include "../config.php";

	mysql_query("DELETE FROM dataKost WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM fasilitasKamar WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM fasilitasMandi WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM fotoKost WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM kapasitasKost WHERE id_kost = '$_GET[id]'");
	mysql_query("DELETE FROM kontakKost WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM ratingKost WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM spesifikasiKost WHERE id = '$_GET[id]'");
	mysql_query("DELETE FROM reviewKost WHERE idKost = '$_GET[id]'");
	echo "<script>window.open('index.php?page=daftar', '_SELF')</script>";
?>