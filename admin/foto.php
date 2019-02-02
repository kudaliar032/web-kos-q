<?
	$id = $_GET['id'];
	$sql1 = mysql_query("	SELECT * FROM dataKost dk 
							INNER JOIN fotoKost fk ON dk.id = fk.id WHERE dk.id = $id");
	$um = mysql_fetch_array($sql1);

	include "updateFoto.php";
	include "tambahFoto.php";
	include "hapusFoto.php";
?>
<!-- Header -->
<header class="w3-container">
    <h2><b><i class="fa fa-image"></i> MANAJEMEN FOTO KOST&nbsp;/&nbsp;<?=$um['nama']?></b></h2>
</header>
<div class="w3-container w3-margin-bottom">
	<div class="w3-row">
		<div class="w3-col s6">
			<h3><b>Foto profile</b></h3>
			<div class="w3-container">
				<form method="POST" enctype="multipart/form-data">
					<div class="w3-col s8">
						<input accept="image/jpeg" type="file" name="fotoKT" class="w3-input w3-margin-bottom"/>
					</div>
					<div class="w3-col s4">
						<input type="submit" name="updateKT" class="w3-bar w3-button w3-green" value="UPDATE"/>
					</div>
				</form>
			</div>
		</div>
		<div class="w3-col s6">
			<h3><b>Foto kamar (360&deg;)</b></h3>
			<div class="w3-container">
				<form method="POST" enctype="multipart/form-data">
					<div class="w3-col s8">
						<input accept="image/jpeg" type="file" name="fotoKM" class="w3-input w3-margin-bottom"/>
					</div>
					<div class="w3-col s4">
						<button type="submit" name="updateKM" class="w3-bar w3-button w3-green">UPDATE</button>
					</div>
				</form>		
			</div>
		</div>
		<div class="w3-col s6">
			<div style="width:100%;height:400px;overflow:hidden;" class="w3-center w3-black">
				<img src="../<?=$um['fotoKT']?>" style="height: 400px;"/>
			</div>
		</div>		
		<div class="w3-col s6">
			<iframe width="100%" height="400" allowfullscreen style="border-style:none;" src="../htm/pannellum.htm?panorama=http://localhost/kost/<?=$um['fotoKM']?>&amp;autoLoad=true"></iframe>
		</div>
	</div>
	<hr/>
	<div class="w3-row">
		<h3><b>Tambah foto</b></h3>
			<div class="w3-row">
				<div class="w3-col s2">
					<h4><b>Foto 360&deg;:</b></h4>
				</div>
				<form method="POST" enctype="multipart/form-data">
					<div class="w3-col s8">
						<input accept="image/jpeg" type="file" name="foto360" class="w3-input" required/>
					</div>
					<div class="w3-col s2">
						<input type="submit" name="tambah360" class="w3-button w3-green w3-right w3-bar" value="TAMBAH" />
					</div>
				</form>
			</div>
			<div class="w3-row">
				<div class="w3-col s2">
					<h4><b>Foto biasa:</b></h4>
				</div>
				<form method="POST" enctype="multipart/form-data">
					<div class="w3-col s8">
						<input accept="image/jpeg" type="file" name="fotoBiasa" class="w3-input" required/>
					</div>
					<div class="w3-col s2">
						<input type="submit" name="tambahBiasa" class="w3-button w3-green w3-right w3-bar" value="TAMBAH" />
					</div>
				</form>
			</div>
		<div class="w3-row w3-margin-top w3-margin-bottom">
			<?php
				$hah = mysql_query("SELECT COUNT(*) AS jumlah FROM fotoFoto WHERE id = $_GET[id]");
				$kik = mysql_fetch_array($hah);

				if($kik['jumlah'] == "0") {
					echo "<hr/>";
				}

				$sqlrr = mysql_query("SELECT * FROM fotoFoto WHERE id = $_GET[id] AND jenis = 'biasa'");
				while($hjk = mysql_fetch_array($sqlrr)) { ?>
					<div class="w3-quarter w3-margin-button">
						<div style="width:200px;height:200px;overflow:hidden;">
							<img src="../<?=$hjk['namaFoto']?>" style="height: 200px;"/>
						</div>
				      	<button onclick="window.open('hapusFoto.php?id=<?=$_GET['id']?>&idhapus=<?=$hjk['x']?>', '_SELF')" class="w3-button w3-red w3-center" style="width: 200px;margin-top: 5px;">HAPUS</button>
			      	</div>
      		<? } 	
      			$sqluu = mysql_query("SELECT * FROM fotoFoto WHERE id = $_GET[id] AND jenis = '360'");
      			while($jkl = mysql_fetch_array($sqluu)) { ?>
  					<div class="w3-quarter w3-margin-button">
						<iframe width="200px" height="200px" allowfullscreen style="border-style:none;" src="../htm/pannellum.htm?panorama=http://localhost/kost/<?=$jkl['namaFoto']?>&amp;autoLoad=true"></iframe>
						<button onclick="window.open('hapusFoto.php?id=<?=$_GET['id']?>&idhapus=<?=$jkl['x']?>', '_SELF')" class="w3-button w3-red w3-center" style="width: 200px;margin-top: 5px;">HAPUS</button>
			      	</div>    				

	      	<? } ?>
		</div>
	</div>
</div>