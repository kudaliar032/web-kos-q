<?php
	session_start();
	session_destroy();
	echo "	<script>
				alert('Berhasil logout...!!!');
				location.href='index.php';
			</script>
	";
?>