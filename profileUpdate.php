<?php
	$hbf = mysql_query("SELECT * FROM userBiasa WHERE userBiasa = '$_SESSION[userBiasa]'");
	$bng = mysql_fetch_array($hbf);

	if(isset($_POST['oldpass'])) {
		$fgdd = mysql_query("SELECT COUNT(*) AS jumlah FROM userBiasa WHERE userBiasa = '$_SESSION[userBiasa]' AND pass = '$_POST[oldpass]'");
		$fdgfd = mysql_fetch_array($fgdd);

		$ganti = $fdgfd['jumlah'];
	}

	if((isset($_POST['updateProfile'])) && ($ganti == 1)) {
		if(!empty($_POST['depan'])) {
			mysql_query("UPDATE userBiasa SET depan = '$_POST[depan]' WHERE userBiasa = '$_SESSION[userBiasa]'");
			echo "<script>alert('Nama depan berhasil di update!')</script>";
		}

		if(!empty($_POST['belakang'])) {
			mysql_query("UPDATE userBiasa SET belakang = '$_POST[belakang]' WHERE userBiasa = '$_SESSION[userBiasa]'");
			echo "<script>alert('Nama belakang berhasil di update!')</script>";
		}

		if(!empty($_POST['email'])) {
			mysql_query("UPDATE userBiasa SET email = '$_POST[email]' WHERE userBiasa = '$_SESSION[userBiasa]'");
			echo "<script>alert('Email berhasil di update!')</script>";
		}

		if(!empty($_POST['password1']) && !empty($_POST['password2']) && ($_POST['password1'] == $_POST['password2'])) {
			mysql_query("UPDATE userBiasa SET pass = '$_POST[password1]' WHERE userBiasa = '$_SESSION[userBiasa]'");
			echo "<script>alert('Password berhasil di update!')</script>";
		} elseif(!empty($_POST['password1']) && empty($_POST['password2'])) {
			echo "<script>alert('Konfirmasi password kosong!')</script>";
		} elseif(!empty($_POST['password1']) && !empty($_POST['password2']) && ($_POST['password1'] != $_POST['password2'])) {
			echo "<script>alert('Password dan konfirmasi password berbeda!')</script>";
		}

	} elseif((isset($_POST['updateProfile'])) && ($ganti == 0)) {
		echo "<script>alert('Password salah!')</script>";
	}
?>