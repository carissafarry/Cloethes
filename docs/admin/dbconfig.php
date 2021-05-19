<?php 
	// koneksi ke database (secara secure dengan mysqli_select_db())
	$server_name = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "cloethes_db";
	//$table_name = "new_produk"

	$conn = mysqli_connect($server_name,$db_username,$db_password);
	$dbconfig = mysqli_select_db($conn,$db_name);

	if(!$dbconfig) {
		include '../404.php';
	}
	
?>