<?php
	if(isset($_GET['id'])) {
		include "../config.php";
		$sqlHapus = mysql_query("DELETE FROM userAdmin WHERE idAdmin = $_GET[id]");
		echo "<script>location.href='index.php?page=userAdmin'</script>";

		mysql_query("ALTER TABLE userAdmin DROP idAdmin");
		mysql_query("ALTER TABLE userAdmin ADD idAdmin BIGINT(20) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (idAdmin)");
	}
?>