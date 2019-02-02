<?php
	if(isset($_POST['gantiPassword'])) {
		$username = $_POST['username'];
		$oldpass = $_POST['oldpass'];
		$newpass1 = $_POST['newpass1'];
		$newpass2 = $_POST['newpass2'];	

		$kio = mysql_query("SELECT * FROM userAdmin WHERE username = '$username'");
		$yvm = mysql_fetch_array($kio);

		if(($oldpass == $yvm['password']) && ($newpass1 == $newpass2) && ($oldpass != $newpass1)) {
			mysql_query("UPDATE userAdmin SET password = '$newpass1' WHERE idAdmin = $yvm[idAdmin]");
			echo "<script>alert('Password berhasil di update.')</script>";
		} elseif($oldpass != $yvm['password']) {
			echo "<script>alert('Password lama salah.')</script>";
		} elseif($newpass1 != $newpass2) {
			echo "<script>alert('Password baru tidak sama.')</script>";
		} elseif ($oldpass == $newpass1 || $oldpass == $newpass2) {
			echo "<script>alert('Password baru sama dengan password lama.')</script>";
		}
	}



?>