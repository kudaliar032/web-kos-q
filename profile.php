<?php
	session_start();

	if(!isset($_SESSION['userBiasa']) && !isset($_SESSION['pass'])) {
		echo "<script>location.href='index.php'</script>";
	}

	include "config.php";
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
		<link rel="icon" href="img/logo.png" type="image/x-icon">
		
		<title>PROFILE</title>
		<!-- load stlye dari 23 -->
		<link rel="stylesheet" type="text/css" href="css/w3.css"/>
		<link rel="stylesheet" type="text/css" href="css/warna.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- load bootsrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>

		<style>
			/** lain lain **/
            html, body {
				height: 100%;
				width: 100%;
            }
			google-map {
				height: 700px;
				width: 100%;
			}
			#map {
				height: 100%;
			}
			.limitTampil {
				display: none;
			}

		</style>
  	</head>
  	<body>
  		<!-- membuat bar -->
		<div class="w3-top">
			<div class="w3-bar w3-xlarge w3-theme-d4">
				<button href="javascript:void(0)" onclick="myFunction()" class="w3-hide-large w3-hide-medium w3-bar-item w3-button w3-hover-theme">
					<b><i class="fa fa-bars" aria-hidden="true"></i></b>
				</button>

				<div class="w3-bar-item"><b>KOS-Q</b>
				</div>

				<button onclick="location.href='index.php'" class="w3-hide-small w3-bar-item w3-button w3-hover-theme">
					<b><i class="fa fa-home" aria-hidden="true"></i></b>
				</button>

				<button onclick="location.href='banding.php'" class="w3-hide-small w3-bar-item w3-button w3-hover-theme">
					<b>BANDINGKAN</b>
				</button>

				<button onclick="location.href='logout.php'" class="w3-hode-small w3-bar-item w3-button w3-hover-theme w3-right">
							<i class="fa fa-sign-out" aria-hidden="true"></i> Logout
				</button>
			</div>

			<div id="demo" class="w3-bar-block w3-theme-d4 w3-hide w3-hide-large w3-hide-medium">
				<button onclick="location.href='index.php'" class="w3-bar-item w3-button w3-hover-theme">
					<i class="fa fa-home" aria-hidden="true"></i> Home
				</button>
				<button onclick="location.href='banding.php'" class="w3-bar-item w3-button">
					<i class="fa fa-exchange" aria-hidden="true"></i> Bandingkan
				</button>
			</div>
		</div>
		<div class="w3-bar w3-xlarge w3-theme-d4">
			<div class="w3-bar-item"><b>KOS-Q</b>
			</div>
		</div>

		<?php
			include "profileUpdate.php";
			
			$yhb = mysql_query("SELECT * FROM userBiasa WHERE userBiasa = '$_SESSION[userBiasa]'");
			$nmf = mysql_fetch_array($yhb);

			$yka = mysql_query("SELECT *, COUNT(*) AS jumlah FROM reviewKost WHERE idUser = $nmf[id]");
			$nme = mysql_fetch_array($yka);

			$hash = md5(strtolower(trim($nmf['email'])));
			$size = 200;
			$gravatar = "http://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
		?>

		<div class="w3-content">
			<div class="w3-container">
				<div class="w3-col l2 m2 s12">&nbsp;</div>
				<div class="w3-col l8 m8 s12 w3-margin-bottom">

					<div class="w3-row">
						<div class="w3-col l3 m3 s3">&nbsp;</div>
						<div class="w3-col l6 m6 s6">
							<div class="w3-padding">
								<img src="<?=$gravatar?>" class="w3-image w3-margin-top w3-circle" style="width: 100%"/>
							</div>
						</div>
						<div class="w3-col l6 m6 s6">&nbsp;</div>
					</div>
					<div class="w3-xxlarge w3-margin-top w3-center">
						<b>
							<?=$nmf['depan']?>&nbsp;<?=$nmf['belakang']?>
						</b>
					</div>

					<form method="POST">
						<div class="w3-row w3-section">
							<div class="w3-large w3-margin-top w3-margin-bottom">
								<b>Data user:</b>
							</div>
							<label>Username:</label>
							<input class="w3-input w3-border" type="text" name="userBiasa" value="<?=$nmf['userBiasa']?>" disabled/>							
						</div>
						<div class="w3-row w3-section">
							<label>Kost:</label>
							<input class="w3-input w3-border" type="text" name="namaKost" value="<?=$nmf['namaKost']?>" id="namaKost" disabled/>
						</div>							
						<div class="w3-row w3-section">
							<label>Nama depan:</label>
							<input class="w3-input w3-border" type="text" name="depan" placeholder="<?=$nmf['depan']?>" id="depan"/>
						</div>					
						<div class="w3-row w3-section">
							<label>Nama belakang:</label>
							<input class="w3-input w3-border" type="text" name="belakang" placeholder="<?=$nmf['belakang']?>"/>
						</div>							
						<div class="w3-row w3-section">
							<label>Email:</label>
							<input class="w3-input w3-border" type="text" name="email" placeholder="<?=$nmf['email']?>"/>
						</div>

						<div class="w3-row w3-section">
							<div class="w3-large w3-margin-top w3-margin-bottom">
								<b>Ganti password:</b>
							</div>
							<input class="w3-input w3-border" type="password" name="password1" placeholder="Password baru" />
						</div>					
						<div class="w3-row w3-section">
							<input class="w3-input w3-border" type="password" name="password2" placeholder="Konfirmasi Password baru"/>
						</div>


						<div class="w3-row w3-section">
							<div class="w3-large w3-margin-top w3-margin-bottom">
								<b>Masukan password untuk menyimpan:</b>
							</div>
							<input class="w3-input w3-border" type="password" name="oldpass" placeholder="Password lama" required/>
						</div>			
						
						<input class="w3-right w3-border w3-button w3-theme-dark w3-hover-theme" type="submit" name="updateProfile" value="UPDATE"/>	
					</form>
					<?php
						if($nme['jumlah'] == 1) {
					?>
						<button onclick="location.href='tampil.php?id=<?=$nme['idKost']?>'" class="w3-margin-right w3-right w3-border w3-button w3-flat-pomegranate w3-hover-red">TAMPILKAN REVIEW SAYA</button>
					<?php
						}
					?>
				</div>
				<div class="w3-col l2 m2 s12">&nbsp;</div>
			</div>
		</div>

		<script type="text/javascript">
			function myFunction() {
			    var x = document.getElementById("demo");
			    if (x.className.indexOf("w3-show") == -1) {
			        x.className += " w3-show";
			    } else { 
			        x.className = x.className.replace(" w3-show", "");
			    }
			}
		</script>

<?php
	include "bawah.php";
?>

