<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN ADMIN</title>
		 <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="../css/w3.css">
	    <link rel="stylesheet" href="../css/warna.css">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <style>
	        html, body {
	            height: 100%;
	            width: 100%;
	        }
	    </style>

	    <script>
			function pesan(kondisi, pesan) {
				if(kondisi == 'salah') {
					document.getElementById('pesan').innerHTML = "<div class='w3-row w3-red w3-padding'>"+pesan+"</div>";
				} else if (kondisi == 'benar') {
					document.getElementById('pesan').innerHTML = "<div class='w3-row w3-green w3-padding'>"+pesan+"</div>";
				}		
			}
		</script>
	</head>
	<body class="w3-display-container">

  <div class="w3-light-grey">
    <div id="myBar" class="w3-container w3-green" style="height:24px;width:0%;display: none">
    </div>
  </div>

<script type="text/javascript">
	function logincuy() {
		var waktu = 100;
		var berkurang = setInterval(function(){
		  	document.getElementById("myBar").style.width = (100 - --waktu) + '%';
		  	if(waktu <= 0) {
		  		clearInterval(berkurang);
				if(waktu == 0) {
					location.href='index.php';
				}
		  	}
		},10);
	}
</script>


		<div class="w3-display-middle w3-hide-small">
			<div class="w3-row w3-card-4 w3-animate-zoom" style="max-width:500px">
				<div class="w3-center"><br>
					<img src="../img/logo.png" alt="logo" style="width:50%" class="w3-margin">
				</div>

				<form class="w3-container" method="POST">

					<div class="w3-row w3-medium w3-center" id="pesan"></div>

					<div class="w3-section">
						<input id="usr" class="w3-input w3-border-bottom w3-margin-bottom" type="text" placeholder="Username" name="usr" required>
						<input id="psw" class="w3-input w3-border-bottom" type="password" placeholder="Password" name="psw" required>

						<input class="w3-button w3-block w3-theme-dark w3-hover-theme w3-section w3-padding" type="submit" value="Masuk" name="loginAdmin">
					</div>
				</form>


		    </div>
		</div>
		<?php
			include "../config.php";
			if(isset($_POST['loginAdmin'])) {
				$sdfsd = mysql_query("SELECT COUNT(*) AS qwerty FROM userAdmin WHERE username = '$_POST[usr]' AND password = '$_POST[psw]'");
				$fdgdk = mysql_fetch_array($sdfsd);

				$bgh = mysql_query("SELECT COUNT(*) AS vbn FROM userAdmin WHERE username = '$_POST[usr]'");
				$mkh = mysql_fetch_array($bgh);

				if($fdgdk['qwerty'] == 1) {
					session_start();

					$_SESSION['usradmin'] = $_POST['usr'];
					$_SESSION['pswadmin'] = $_POST['psw'];
					$_SESSION['wktadmin'] = time();
					unset($_POST);

					echo "	<script>
								pesan('benar', 'LOGIN BERHASIL');
								document.getElementById('myBar').style.display = 'block';
								logincuy();
							</script>";
				} elseif($fdgdk['qwerty'] == 0 && $mkh['vbn'] == 1) {
					echo "	<script>
								pesan('salah', 'PASSWORD SALAH!!!');
								document.getElementById('usr').value = '" . $_POST['usr'] . "';
								document.getElementById('psw').focus();
							</script>";
				} else {
					echo "	<script>
								pesan('salah', 'USERNAME & PASSWORD SALAH!!!');
								document.getElementById('usr').focus();
							</script>";
				}
			}
		?>
	</body>
</html>