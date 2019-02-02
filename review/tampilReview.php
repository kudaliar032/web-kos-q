<?php
	include "review/tambahReview.php";
?>
<div class="w3-row w3-margin-bottom">
	<?php
		if($jkl['jumlahReview'] == 0) {  ?>
			<div class="w3-medium">Tidak ditemukan review, jika anda penghuni kost ini berikan review anda sekarang...</div>
	<?php
		}
		$moh = mysql_query("SELECT * FROM reviewKost rk INNER JOIN userBiasa ub ON rk.idUser = ub.id WHERE rk.idKost = $_GET[id]");
		while ($kol = mysql_fetch_array($moh)) {
			$hash = md5(strtolower(trim($kol['email'])));
			$size = 200;
			$gravatar = "http://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
	?>
	<div class="w3-row">
		<div class="w3-row">
			<div class="w3-col l1 w3-padding-small"	style="margin-top: 6px">
				<img src="<?=$gravatar?>" class="w3-image w3-hide-small w3-hide-medium">
			</div>
			<div class="w3-col l11 w3-padding-small">
				<div class="w3-medium w3-large"><b><?=$kol['depan']?> <?=$kol['belakang']?></b>
					<?php
						if(isset($_SESSION['userBiasa']) && isset($_SESSION['pass'])) {
							if($kol['userBiasa'] == $_SESSION['userBiasa']) { 
								$iduserr = $kol['id'];
								$idpagess = $_GET['id'];
					?>
								<i onclick="location.href='review/hapusReview.php?iduser=<?=$iduserr?>&idpage=<?=$idpagess?>'" class="w3-hover-white fa fa-times-circle w3-text-red w3-large w3-padding-small" aria-hidden="true"></i>
					<?php
							}
						}
					?>
				</div>
				<div class="w3-justify w3-large"><?=$kol['review']?></div>
			</div>
		</div>
		<div class="w3-row w3-padding-small w3-border-bottom">
			<div class="w3-col l12">
				<div class="w3-row w3-right w3-margin-right">
					<div class="w3-medium">
						<i><?=$kol['tanggal']?></i>
					</div>
				</div>
				<div class="w3-row w3-right w3-margin-right">
		            <?php
		            	$ratKenyamanan = $kol['kenyamanan'];
		            	$ratKeamanan = $kol['keamanan'];
		            	$ratKebersihan = $kol['kebersihan'];
		            	$jumlahRating = round(($ratKenyamanan + $ratKeamanan + $ratKebersihan)/3);

		                for($a=0; $a<$jumlahRating; $a++) {
		                    echo "<span class='w3-large fa fa-star checked'></span>";
		                }
		                for($a=0; $a<abs($jumlahRating-5); $a++) {
		                    echo "<span class='w3-large fa fa-star'></span>";
		                }
		            ?>
				</div>
			</div>
		</div>
	</div>
		
	<?php
		}
	?>
	
	<div class="w3-row w3-margin-top">		
		<div class="w3-row w3-large w3-margin-top">
			<b>
				Kirimkan review anda:
			</b>
		</div>

		<?php
			if(isset($_SESSION['userBiasa']) && isset($_SESSION['pass'])) { ?>
			<form method="POST">
				<table class="w3-margin-bottom">
					<tr>
						<td style="vertical-align: bottom;"><b class="w3-margin-right">Kenyamanan: </b></td>
						<td>
							<input type="radio" class="w3-radio" name="kenyamanan" value="1" required/>
							<input type="radio" class="w3-radio" name="kenyamanan" value="2" required/>
							<input type="radio" class="w3-radio" name="kenyamanan" value="3" required/>
							<input type="radio" class="w3-radio" name="kenyamanan" value="4" required/>
							<input type="radio" class="w3-radio" name="kenyamanan" value="5" required/>	
						</td>
					</tr>
					<tr>
						<td style="vertical-align: bottom;"><b class="w3-margin-right">Keamanan: </b></td>
						<td>
							<input type="radio" class="w3-radio" name="keamanan" value="1" required/>
							<input type="radio" class="w3-radio" name="keamanan" value="2" required/>
							<input type="radio" class="w3-radio" name="keamanan" value="3" required/>
							<input type="radio" class="w3-radio" name="keamanan" value="4" required/>
							<input type="radio" class="w3-radio" name="keamanan" value="5" required/>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: bottom;"><b class="w3-margin-right">Kebersihan: </b></td>
						<td>
							<input type="radio" class="w3-radio" name="kebersihan" value="1" required/>
							<input type="radio" class="w3-radio" name="kebersihan" value="2" required/>
							<input type="radio" class="w3-radio" name="kebersihan" value="3" required/>
							<input type="radio" class="w3-radio" name="kebersihan" value="4" required/>
							<input type="radio" class="w3-radio" name="kebersihan" value="5" required/>
						</td>
					</tr>
				</table>
				<div class="w3-row">
						<textarea name="review" class="w3-input w3-border" rows="7" placeholder="Masukan review disini..." required></textarea>
				</div>
				<input class="w3-right w3-button w3-green w3-margin-top w3-theme-d3 w3-hover-theme" type="submit" name="kirimReview" value="Kirim Review">
			</form>
		<?php
			} else {
		?>
				<h5 class="w3-margin-top">Untuk mengirimkan review, anda harus login terlebih dahulu <a onclick="document.getElementById('formulir').style.display='block'">disini</a>...</h5>
		<?php
			}
		?>
	</div>
</div>

