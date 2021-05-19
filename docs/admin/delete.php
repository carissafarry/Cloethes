<?php
	session_start();

	// bila user tidak dapat login (tidak ada session login)
	/*if( !isset($_SESSION["login"]) ) {
		header("Location: register.php");
		exit;
	}*/
	
	require 'function.php';

	$id = $_GET["id"];

	if( delete($id) > 0 ) {
		// menggunakan javascript untuk menampilkan notifikasi
		echo "
			<script>
				alert('Data deleted!');
				document.location.href = 'register.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data gagal dihapus!');
				document.location.href = 'register.php';
			</script>
		";
	}

?>