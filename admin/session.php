<?php
	session_start();
	require 'database/dbconfig.php';

	if( !isset($_SESSION["login"]) ) {
	    header("Location: login.php");
	    exit;
  	}
 ?>