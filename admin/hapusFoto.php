<?php
	if(isset($_GET['idhapus'])) {
		include "../config.php";
		$idhapus = $_GET['idhapus'];

		$sqloo = mysql_query("SELECT * FROM fotoFoto WHERE x = $idhapus");
		$kok = mysql_fetch_array($sqloo);

		$namaHapus = "../" . $kok['namaFoto'];
		unlink($namaHapus);

		$sqll = mysql_query("DELETE FROM fotoFoto WHERE x = $idhapus");

		echo "<script>location.href='index.php?page=foto&id=" . $_GET['id'] . "'</script>";
	}
?>