<?php
	include "../config.php";

	$dfdf = mysql_fetch_array(mysql_query("SELECT dk.id AS kambing FROM userBiasa ub INNER JOIN dataKost dk ON ub.namaKost = dk.nama WHERE ub.id = $_GET[id]"));

	mysql_query("DELETE FROM userBiasa WHERE id = $_GET[id]");

	mysql_query("UPDATE kapasitasKost SET kapasitas = kapasitas + 1 WHERE id_kost = $dfdf[kambing]");

	echo "<script>location.href='index.php?page=home';</script>";
?>