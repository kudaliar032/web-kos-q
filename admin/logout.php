<?php
	session_start();
	session_destroy();
	echo "	<script>
				alert('BERHASIL LOGOUT...!!!');
				window.open('index.php', '_SELF');
			</script>
	";
?>