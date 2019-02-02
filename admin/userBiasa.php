<!-- Header -->
<header class="w3-container">
    <b><h2><i class="fa fa-users"></i><b>&nbsp;&nbsp;MANAJEMEN USER BIASA</b></h2></b>
</header>

<?php
	include "updatePassBiasa.php";
?>

<div class="w3-container">
	<ul class="w3-ul">
		<table class="w3-table w3-striped w3-bordered w3-hoverable">
		    <tr>
		    	<th>ID</th>
		      	<th>Nama</th>
		      	<th>Kost</th>
		      	<th class="w3-right">Menu</th>
		    </tr>
		<?php
			$bnf = mysql_query("SELECT * FROM userBiasa");
			while($tyu = mysql_fetch_array($bnf)) { ?>

			<tr>
				<td class="w3-large"><?=$tyu['id']?></td>
				<td class="w3-large">
					<b><?=$tyu['depan']?>&nbsp;<?=$tyu['belakang']?></b>
				</td>				
				<td class="w3-large">
					<b><?=$tyu['namaKost']?></b>
				</td>
				<td>
					<span onclick="location.href='hapusUserBiasa.php?id=<?=$tyu['id']?>'" class="w3-hover-light-grey w3-button w3-red w3-large w3-right">
	                	<i class="fa fa-ban" aria-hidden="true"></i>
	            	</span>
	            	<span onclick="document.getElementById('ubahPassword<?=$tyu['id']?>').style.display='block'" class="w3-hover-light-grey w3-button w3-blue w3-large w3-right w3-margin-right">
	                	<i class="fa fa-key" aria-hidden="true"></i>
	            	</span>
	            	<div class="w3-modal" id="ubahPassword<?=$tyu['id']?>">
						<div class="w3-modal-content w3-padding-large">
							<div class="w3-bar">
								<div class="w3-xlarge w3-center"><b>UBAH PASSWORD</b></div>
							</div>
								<div class="w3-container w3-margin-bottom">
						      	<form method="POST">			
									<div class="w3-row w3-section">
										<input type="text" value="<?=$tyu['userBiasa']?>" name="userBiasa" hidden>
										<input class="w3-input" type="password" placeholder="Password baru" name="newpass1"/>
									</div>	
									<div class="w3-row w3-section">
										<input class="w3-input" type="password" placeholder="Konfirmasi password baru" name="newpass2"/>
									</div>
									<div class="w3-row-padding">
										<div class="w3-col s6">
											<input onclick="document.getElementById('ubahPassword<?=$tyu['id']?>').style.display='none'" class="w3-input w3-button w3-red" value="BATAL" />
										</div>
										<div class="w3-col s6">
											<input class="w3-input w3-button w3-green" type="submit" name="gantiPassword" value="UBAH PASSWORD" />
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>


	            	<?php
						if($tyu['status'] == 0) { ?>
							<span onclick="location.href='verifikasiUser.php?id=<?=$tyu['id']?>'" class="w3-right w3-button w3-green w3-hover-light-grey w3-large w3-margin-right">VERIFIKASI</span>
					<?
						}
					?>
				</td>
			</tr>
	    <?php
	    	}
	    ?>
	    </table>
    </ul>
</div>