<?php
	$dir_tujuan = "fotoKost/fotoFoto/";

	if(isset($_POST['tambahBiasa'])) {
		$namaBiasa = explode(".", $_FILES['fotoBiasa']['name']);
		$formatBiasa = end($namaBiasa);

		$dbBiasa = $dir_tujuan . time() . "." . $formatBiasa;

		move_uploaded_file($_FILES['fotoBiasa']['tmp_name'], "../".$dbBiasa);

		$sql1 = mysql_query("INSERT INTO fotoFoto VALUES ('', '$_GET[id]', '$dbBiasa', 'biasa')");

		echo "<script>location.href='?page=foto&id=" . $_GET['id'] . "'</script>";
	}

	if(isset($_POST['tambah360'])) {
		$namaBiasa = explode(".", $_FILES['foto360']['name']);
		$formatBiasa = end($namaBiasa);

		$dbBiasa = $dir_tujuan . time() . "." . $formatBiasa;

		move_uploaded_file($_FILES['foto360']['tmp_name'], "../".$dbBiasa);

		$sql1 = mysql_query("INSERT INTO fotoFoto VALUES ('', '$_GET[id]', '$dbBiasa', '360')");

		echo "<script>location.href='?page=foto&id=" . $_GET['id'] . "'</script>";
	}
?>