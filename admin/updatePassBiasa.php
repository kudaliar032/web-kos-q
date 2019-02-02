<?php
	if(isset($_POST['gantiPassword'])) {
		$userBiasa = $_POST['userBiasa'];
		$newpass1 = $_POST['newpass1'];
		$newpass2 = $_POST['newpass2'];	

		if($newpass1 == $newpass2) {
			mysql_query("UPDATE userBiasa SET pass = '$newpass1' WHERE userBiasa = '$userBiasa'");
			echo "<script>alert('Password berhasil di update.')</script>";
		} elseif($newpass1 != $newpass2) {
			echo "<script>alert('Password baru tidak sama.')</script>";
		}
	}
?>