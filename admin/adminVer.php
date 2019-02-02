<?php
	include "../config.php";
	mysql_query("UPDATE userBiasa SET status = 1 WHERE id = $_GET[id]");
	echo "<script>location.href='index.php?page=home';</script>";
?>