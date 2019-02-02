<?php
	include "config.php";

	if(isset($_POST['kirim'])) {
		$depan = $_POST['depan'];
		$belakang = $_POST['belakang'];
		$userBiasa = $_POST['username'];
		$email = $_POST['email'];
		$namaKost = $_POST['namaKost'];
		$pass1 = $_POST['password1'];
		$pass2 = $_POST['password2'];

		$dfbg = mysql_query("SELECT *, COUNT(*) AS jumlah FROM userBiasa WHERE userBiasa = '$userBiasa'");
		$bgd = mysql_fetch_array($dfbg);

		$tidak = 1;

		if($pass2 == null) { ?>
			<script type="text/javascript">
				var pass2 = document.getElementById('password2');
				pass2.focus();
				document.getElementById('pesanKonfir').innerHTML = "Konfirmasi password kosong";
			</script>
<?php
			$tidak = 0;
		}

		if($pass1 == null) { ?>
			<script type="text/javascript">
				var pass1 = document.getElementById('password1');
				pass1.focus();
				document.getElementById('pesanPass').innerHTML = "Password kosong";
			</script>
<?php
			$tidak = 0;
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { ?>
			<script type="text/javascript">
				var email = document.getElementById('email');
				email.focus();
				document.getElementById('pesanEmail').innerHTML = "Harus dalam format email";
			</script>
<?php
			$tidak = 0;
		}

		if($email == "") { ?>
			<script type="text/javascript">
				var email = document.getElementById('email');
				email.focus();
				document.getElementById('pesanEmail').innerHTML = "Email kosong";
			</script>
<?php
			$tidak = 0;
		}

		if(!preg_match("/^[a-zA-Z0-9]*$/", $userBiasa)) { ?>
			<script type="text/javascript">
				var userBiasa = document.getElementById('username');
				userBiasa.focus();
				document.getElementById('pesanUser').innerHTML = "Huruf dan angka saja";
			</script>
<?php
			$tidak = 0;
		}

		if($userBiasa == "") { ?>
			<script type="text/javascript">
				var userBiasa = document.getElementById('username');
				userBiasa.focus();
				document.getElementById('pesanUser').innerHTML = "Username kosong";
			</script>
<?php
			$tidak = 0;
		}

		if(!preg_match("/^[a-zA-Z ]*$/", $belakang)) { ?>
			<script type="text/javascript">
				var belakang = document.getElementById('belakang');
				belakang.focus();
				document.getElementById('pesanBelakang').innerHTML = "Huruf dan spasi saja";
			</script>		
<?php
			$tidak = 0;
		}

		if($belakang == "") { ?>
			<script type="text/javascript">
				var belakang = document.getElementById('belakang');
				belakang.focus();
				document.getElementById('pesanBelakang').innerHTML = "Nama belakang kosong";
			</script>
<?php
			$tidak = 0;
		}

		if(!preg_match("/^[a-zA-Z ]*$/", $depan)) { ?>
			<script type="text/javascript">
				var depan = document.getElementById('depan');
				depan.focus();
				document.getElementById('pesanDepan').innerHTML = "Huruf dan spasi saja";
			</script>		
<?php
			$tidak = 0;
		}				

		if($depan == "") { ?>
			<script type="text/javascript">
				var depan = document.getElementById('depan');
				depan.focus();
				document.getElementById('pesanDepan').innerHTML = "Nama depan kosong";
			</script>
<?php
			$tidak = 0;
		} 

		if($bgd['jumlah'] >= 1 && $tidak == 1) { ?>

					<script>
						var pesanLogin = document.getElementById('pesanLogin');
						pesanLogin.setAttribute("class", "w3-panel w3-padding w3-red");
						pesanLogin.innerHTML = "Maaf, username sudah digunakan.";
						username.focus();
					</script>

<?php
		} elseif(($pass1 != $pass2) && $tidak == 1) {
			echo "	<script>
						var pass1 = document.getElementById('password1');
						document.getElementById('pesanKonfir').innerHTML = 'Password dan konfirmasi tidak sama';
						pass1.focus();
					</script>";
		} elseif(($pass1 == $pass2) && $tidak == 1) {

			$ghfgf = mysql_fetch_array(mysql_query("SELECT * FROM dataKost WHERE nama = '$namaKost'"));
			$ffdgg = mysql_fetch_array(mysql_query("SELECT * FROM kapasitasKost WHERE id_kost = $ghfgf[id]"));
			if($ffdgg['kapasitas'] > 0) {
				mysql_query("INSERT INTO userBiasa VALUES('', '$depan', '$belakang', '$userBiasa', '$email', '$namaKost', '$pass1', '0')");
				mysql_query("UPDATE kapasitasKost SET kapasitas = kapasitas - 1 WHERE id_kost = $ghfgf[id]"); ?>

				<script type="text/javascript">
					document.getElementById('depan').value = null;
					document.getElementById('belakang').value = null;
					document.getElementById('username').value = null;
					document.getElementById('email').value = null;

					var pesanLogin = document.getElementById('pesanLogin');
					pesanLogin.setAttribute("class", "w3-panel w3-padding w3-green");
					pesanLogin.innerHTML = "Selamat, user berhasil dibuat silahkan tunggu verifikasi admin.";
				</script>

<?php
				unset($_POST);
			} else { ?>

				<script type="text/javascript">
					var pesanLogin = document.getElementById('pesanLogin');
					pesanLogin.setAttribute("class", "w3-panel w3-padding w3-red");
					pesanLogin.innerHTML = "Maaf, kost sudah melebihi kapasitas pastikan anda memilih kost yang benar.";
					document.getElementById('namaKost').focus();
				</script>

<?php
			}
			
		}
	}
?>