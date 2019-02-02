<?php
	include "../config.php";
	mysql_query("DELETE FROM reviewKost WHERE idUser = $_GET[iduser]");

	$link = "../tampil.php?id=" . $_GET[idpage];
	header("Location: $link");
?>