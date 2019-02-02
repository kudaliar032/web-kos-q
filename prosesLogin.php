<?php
	session_start();
	
	include "config.php";

	if(isset($_POST['user'])) {
		$user = strip_tags($_POST['user']);
		$pass = strip_tags($_POST['pass']);
	
		$sql = mysql_query("SELECT *, COUNT(*) AS login FROM userBiasa WHERE userBiasa = '$user' AND pass = '$pass'");
		$data = mysql_fetch_array($sql);

		if($data['login'] == 1 && $data['status'] == 1) {
			$_SESSION['userBiasa'] = $data['userBiasa'];
			$_SESSION['pass'] = $data['pass'];
			$_SESSION['iduser'] = $data['id'];

			$_SESSION['waktu'] = time();

			echo "<div class='w3-bar w3-green w3-center w3-padding' id='time'><b>LOGIN BERHASIL, Halaman akan refresh dalam 3 detik.</b></div>";
			echo "	<script>
						setTimeout('location.reload()', 3000);
					</script>";
		} elseif($_POST['user'] == null && $_POST['pass'] == null) {
			echo "<div class='w3-bar w3-red w3-center w3-padding'><b>USERNAME & PASSWORD KOSONG</b></div>";
		} elseif($_POST['user'] == null) {
			echo "<div class='w3-bar w3-red w3-center w3-padding'><b>USERNAME KOSONG</b></div>";
		} elseif($_POST['pass'] == null) {
			echo "<div class='w3-bar w3-red w3-center w3-padding'><b>PASSWORD KOSONG</b></div>";
		} elseif($data['login'] != 1) {
			echo "<div class='w3-bar w3-red w3-center w3-padding'><b>USERNAME/PASSWORD SALAH</b></div>";
		} elseif($data['status'] == 0) { 
			echo "<div class='w3-bar w3-red w3-center w3-padding'><b>USER TIDAK TERVERFIKASI</b></div>";
		}
	}
?>