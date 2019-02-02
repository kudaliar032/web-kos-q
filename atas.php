<?php
	session_start();
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

		<title><?=$title?></title>
		<!-- load stlye dari 23 -->
		<link rel="stylesheet" type="text/css" href="css/w3.css"/>
		<link rel="stylesheet" type="text/css" href="css/warna.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- load bootsrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>

		<!-- load jquery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- load pannellum -->
		<script src="js/pannellum.js"></script>
		<link rel="stylesheet" href="css/pannellum.css">

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

			/* style auto komlit */
			.kostkost {
				width: 120%;
			}
			.tt-menu {
				background-color: #FFFFFF;
				border: 1px solid rgba(0, 0, 0, 0.2);
				box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
				margin-top: 12px;
				padding: 5px;
			}
			.tt-suggestion {
				text-align: left;
				font-size: 12pt;  /* Set suggestion dropdown font size */
				padding: 5px;
			}
			.tt-suggestion:hover {
				cursor: pointer;
				background-color: #0097CF;
				color: #FFFFFF;
			}
			.tt-suggestion p {
				margin: 0;
			}
			/* auto komplit sampai sini */

			.warna-1 {
				background-color: #001a75;
				color: white;
			}

			/*membuat rating*/
			.checked {
			    color: orange;
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

		<button onclick="location.href='index.php'" class="w3-hide-small w3-bar-item w3-button w3-hover-theme <?=$home?>">
			<b><i class="fa fa-home" aria-hidden="true"></i></b>
		</button>

		<button onclick="location.href='banding.php'" class="w3-hide-small w3-bar-item w3-button w3-hover-theme <?=$aktifBanding?>">
			<b>BANDINGKAN</b>
		</button>

		<!-- tombol login -->
		<?php if(isset($_SESSION['userBiasa']) && isset($_SESSION['pass'])) { 
					$yhb = mysql_query("SELECT * FROM userBiasa WHERE userBiasa = '$_SESSION[userBiasa]'");
					$nmf = mysql_fetch_array($yhb); 

					$hash = md5(strtolower(trim($nmf['email'])));
					$size = 200;
					$gravatar = "http://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
		?>

			<!-- tulisan login waktu besar sama sedang -->
			<div class="w3-dropdown-click w3-hover-theme w3-right w3-hide-small">
				<button onclick="fungsiDropdown()" class="w3-button">
					<i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?=$nmf['userBiasa']?>
				</button>

				<div id="dropdown" class="w3-dropdown-content w3-border w3-bar-block w3-medium" style="right:0">
					<div class="w3-row w3-padding">
						<div class="w3-row w3-center">
							<img src="<?=$gravatar?>" class="w3-margin-bottom w3-circle w3-image w3-center" width="100px">
							<div class="w3-medium w3-margin-bottom">
								<?=$nmf['depan']?>
								<?=$nmf['belakang']?>
							</div>
						</div>
						<button onclick="location.href='profile.php'" class="w3-button w3-green">
							<i class="fa fa-user" aria-hidden="true"></i> Profile
						</button>
						<button onclick="location.href='logout.php'" class="w3-button w3-red">
							<i class="fa fa-sign-out" aria-hidden="true"></i> Logout
						</button>
					</div>
		      	</div>
		    </div>

		    <!-- tanda login waktu kecil -->
		    <button onclick="location.href='profile.php'" class="w3-hide-large w3-hide-medium w3-bar-item w3-button w3-hover-theme w3-right">
				<b><i class="fa fa-user-circle-o" aria-hidden="true"></i></b>
			</button>

			<?php } else { ?>

			<button onclick="document.getElementById('formulir').style.display='block'" class="w3-hover-theme w3-bar-item w3-right w3-button w3-hide-small">
				<i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;Login
			</button>

		<?php } ?>
	</div>

	<div id="demo" class="w3-bar-block w3-theme-d4 w3-hide w3-large w3-hide-large w3-hide-medium">
		<button onclick="location.href='index.php'" class="w3-bar-item w3-button w3-hover-theme">
			<i class="fa fa-home" aria-hidden="true"></i> Beranda
		</button>
		<button onclick="location.href='banding.php'" class="w3-bar-item w3-button">
			<i class="fa fa-exchange" aria-hidden="true"></i> Bandingkan
		</button>
		<?php if(isset($_SESSION['userBiasa']) && isset($_SESSION['pass'])) { ?>
			<button onclick="location.href='logout.php'" class="w3-bar-item w3-button">
				<i class="fa fa-sign-out" aria-hidden="true"></i> Logout
			</button>
		<?php } else { ?>
			<button onclick="document.getElementById('formulir').style.display='block'" class="w3-bar-item w3-button">
				<i class="fa fa-sign-in" aria-hidden="true"></i> Login
			</button>
		<?php
			}
		?>

	</div>
</div>



<!-- form login -->
<div id="formulir" class="w3-modal" style="align: center;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom w3-margin-top w3-margin-bottom" style="max-width:600px">
        <div class="w3-center"><br>
        	<span onclick="document.getElementById('formulir').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright w3-circle w3-hover-white w3-hover-text-red" title="Close Modal">×</span>
        	<div class="w3-xxlarge"><b>LOGIN USER KOS-Q</b></div>  
        </div>

        <div class="w3-container">
			<form id="formLogin">
				<fieldset style="border-style:hidden">
					<div class="w3-section">
						<label><b><i class="fa fa-user" aria-hidden="true"></i> Username</b></label>
						<input class="w3-input w3-border w3-margin-bottom" type="text" name="user" id="user"/>
						<label><b><i class="fa fa-key" aria-hidden="true"></i> Password</b></label>
						<input class="w3-input w3-border w3-margin-bottom" type="password" name="pass" id="pass"/>
					</div>
				</fieldset>
			</form>
		</div>

		<div id="warningLogin"></div>
		<div id="gagalLogin"></div>
		<div class="w3-container w3-round-large w3-border-top w3-padding-16 w3-light-grey">
			<button type="submit" id="login" name="login" class="w3-right w3-button w3-theme-dark w3-hover-theme"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN</button>
			<button onclick="location.href='daftarAkun.php'" class="w3-right w3-button w3-flat-pomegranate w3-hover-red w3-margin-right"><i class="fa fa-user-plus" aria-hidden="true"></i> DAFTAR</button>
		</div>

			
		</div>
</div>
<script>
	function myFunction() {
	    var x = document.getElementById("demo");
	    if (x.className.indexOf("w3-show") == -1) {
	        x.className += " w3-show";
	    } else { 
	        x.className = x.className.replace(" w3-show", "");
	    }
	}	

	function fungsiDropdown() {
	    var x = document.getElementById("dropdown");
	    if (x.className.indexOf("w3-show") == -1) {
	        x.className += " w3-show";
	    } else { 
	        x.className = x.className.replace(" w3-show", "");
	    }
	}


	 $(function() {
		$("button#login").click(function(){
		   	$.ajax({
    		   	type: "POST",
				url: "prosesLogin.php",
				data: $('form#formLogin').serialize(),
        		success: function(msg){
 	          		$("#warningLogin").html(msg);
 		        	document.getElementById('formulir').style.display=('block');	
 		        },
				error: function(){
					$("#gagalLogin").html("<div class='w3-bar w3-red w3-center w3-padding'><b>GAGAL LOGIN!</b></div>");
				}
      		});
		});

		$("#formLogin input").keydown(function(e) {
			if (e.keyCode == 13) {
				$.ajax({
	    		   	type: "POST",
					url: "prosesLogin.php",
					data: $('form#formLogin').serialize(),
	        		success: function(msg){
	 	          		$("#warningLogin").html(msg);
	 		        	document.getElementById('formulir').style.display=('block');
	 		        },
					error: function(){
						$("#gagalLogin").html("<div class='w3-bar w3-red w3-center w3-padding'><b>GAGAL LOGIN!</b></div>");
					}
	      		});
			}
		})
	});
</script>

