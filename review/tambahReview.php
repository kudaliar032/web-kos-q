<?php
	include "config.php";

	if(isset($_POST['kirimReview']) && isset($_SESSION['iduser'])) {
		$iou = mysql_query("SELECT COUNT(*) AS jumlah FROM reviewKost WHERE idUser = $_SESSION[iduser]");
		$oye = mysql_fetch_array($iou);
		if($oye['jumlah'] == 0) {
			mysql_query("INSERT INTO reviewKost VALUES('', '$_GET[id]', '$_SESSION[iduser]', '$_POST[review]', CURRENT_TIMESTAMP, '$_POST[kenyamanan]', '$_POST[keamanan]', '$_POST[kebersihan]', '')");

			// recount id dari review
			mysql_query("ALTER TABLE reviewKost DROP idKomentar");
			mysql_query("ALTER TABLE reviewKost ADD idKomentar BIGINT(20) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (idKomentar)");

			echo "	<script>
						alert('Terimakasih, review anda telah terkirim!!!');
						location.reload();
					</script>";

		} elseif($oye['jumlah'] >= 1) {
			echo "<script>alert('Anda telah membuat review sebelumnya!!!')</script>";
		}
	}
?>