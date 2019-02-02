<!doctype html>
<?php
	include "config.php";
?>
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

		<title>DAFTAR AKUN</title>
		<!-- load stlye dari 23 -->
		<link rel="stylesheet" type="text/css" href="css/w3.css"/>
		<link rel="stylesheet" type="text/css" href="css/warna.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- load bootsrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>

		<style type="text/css">
			html, body {
				height: 100%;
				width: 100%;
			}

			.tooltip {
			    position: relative;
			    display: inline-block;
			    border-bottom: 1px dotted black;
			}

			.tooltip .tooltiptext {
			    visibility: visible;
			    width: 120px;
			    background-color: black;
			    color: #fff;
			    text-align: center;
			    border-radius: 6px;
			    padding: 5px 0;
			    position: absolute;
			    z-index: 1;
			    top: -5px;
			    right: 110%;
			}

			.tooltip .tooltiptext::after {
			    content: "";
			    position: absolute;
			    top: 50%;
			    left: 100%;
			    margin-top: -5px;
			    border-width: 5px;
			    border-style: solid;
			    border-color: transparent transparent transparent black;
			}
			.tooltip:hover .tooltiptext {
			    visibility: visible;
			}
		</style>
  	</head>
  	<body>
		<!-- membuat bar -->
		<div>
			<div class="w3-bar w3-xlarge w3-theme-d4">
				<div class="w3-bar-item"><b>KOS-Q</b>
				</div>

				<button onclick="location.href='index.php'" class="w3-bar-item w3-button w3-hover-theme <?=$home?>">
					<b><i class="fa fa-home" aria-hidden="true"></i></b>
				</button>
			</div>
		</div>

		<!-- membuat bar waktu kecil dan sedang-->
		<div class="w3-top">
			<div class="w3-bar w3-xlarge w3-theme-d4">
				<div class="w3-bar-item"><b>KOS-Q</b>
				</div>

				<button onclick="location.href='index.php'" class="w3-bar-item w3-button w3-hover-theme <?=$home?>">
					<b><i class="fa fa-home" aria-hidden="true"></i></b>
				</button>
			</div>
		</div>

		<div class="w3-row" style="height: 100%">
			<div class="w3-content w3-padding w3-margin-bottom">
				<div class="w3-row w3-center w3-xxlarge w3-margin-bottom">
					<b>Buat akun KOS-Q</b>
				</div>
				<div class="w3-col l6 m12 s12 w3-center">
					<h2>Cari kost yang sesuai kebutuhanmu disini</h2>
					Masukan lokasimu, maka kami akan memberikan saran yang terbaik.
					<div class="w3-container w3-padding-large w3-hide-small">
						<img src="img/signup.png" class="w3-image" />
					</div>
				</div>
				<div class="w3-col l6 m12 s12 w3-padding w3-margin-bottom">
					<form method="POST">
					<div class="w3-light-grey w3-padding w3-border w3-margin-top">
						<div class="w3-row-padding w3-margin-top">
							<div class="w3-half">
								<input class="w3-input w3-border" type="text" name="depan" placeholder="Nama depan" id="depan"/>
								<div id="pesanDepan" class="w3-text-red" style="font-style: italic;margin-top: 2px;"></div>
							</div>
							<div class="w3-half">
								<input class="w3-input w3-border" type="text" name="belakang" placeholder="Nama belakang" id="belakang"/>
								<div id="pesanBelakang" class="w3-text-red" style="font-style: italic;margin-top: 2px;"></div>
							</div>

						</div>

						<div class="w3-row-padding">
							<div class="w3-row-padding">
								<div class="w3-row w3-section">
									<input class="w3-input w3-border" name="username" type="text" placeholder="Username" id="username"/>
									<div id="pesanUser" class="w3-text-red" style="font-style: italic;margin-top: 2px;"></div>
								</div>				
								<div class="w3-row w3-section">
									<input class="w3-input w3-border" name="email" type="text" placeholder="Email" id="email"/>
									<div id="pesanEmail" class="w3-text-red" style="font-style: italic;margin-top: 2px;"></div>
								</div>
								<div class="w3-row w3-section">
									<select class="w3-input" name="namaKost">
										<?php
											$klo = "SELECT * FROM dataKost ORDER BY nama ASC";
											$hgi = mysql_query($klo);
											while ($data = mysql_fetch_array($hgi)) { $namaKost = $data['nama']; ?>

												<option value="<?=$data['nama']?>"
													<?php
														if(isset($_POST['namaKost'])) {
															if($namaKost == $_POST['namaKost']) {
																echo "selected";
															}
														}
													?>
												><?=$data['nama']?></option>
										<?php
											}
										?>
									</select>
								</div>	
								<div class="w3-row w3-section">
									<input class="w3-input w3-border" name="password1" type="password" placeholder="Password" id="password1"/>
									<div id="pesanPass" class="w3-text-red" style="font-style: italic;margin-top: 2px;"></div>
								</div>						
								<div class="w3-row w3-section">
									<input class="w3-input w3-border" name="password2" type="password" placeholder="Konfirmasi password" id="password2"/>
									<div id="pesanKonfir" class="w3-text-red" style="font-style: italic;margin-top: 2px;"></div>
								</div>			
								<div class="w3-row w3-section">
									<input class="w3-input w3-border w3-flat-belize-hole w3-hover-dark-grey" name="kirim" type="submit" value="Daftar">
								</div>
					
								<div id="pesanLogin">
								</div>

							</div>
						</div>
					</div>
					</form>

					<script type="text/javascript">
						document.getElementById('depan').value = "<?=$_POST['depan']?>";
						document.getElementById('belakang').value = "<?=$_POST['belakang']?>";
						document.getElementById('username').value = "<?=$_POST['username']?>";
						document.getElementById('email').value = "<?=$_POST['email']?>";
					</script>

					<?php
						include "daftarAkunNext.php";
					?>
				</div>
			</div>
		</div>


<?php
	include "bawah.php";
?>