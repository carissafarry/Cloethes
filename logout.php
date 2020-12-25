<?php 

	require_once 'session.php';
	include_once 'api_config.php';
	
		// jika logout dari akun google
		//if( $_SESSION['api_login'] ) {
		if( $_SESSION['access_token'] ) {

			//include('api_config.php');
			//$gClient->revokeToken();
			unset($_SESSION['access_token']);
			unset($_SESSION['api_login']);
			$gClient->revokeToken();
			session_destroy();

		} else { // jika logout dari akun email / username
			// memastikan session telah berakhir
			$_SESSION = [];
			session_unset();
			session_destroy();

			// akhiri cookie
			setcookie('id', '', time()-3600 );
			setcookie('key', '', time()-3600 );
		}
/*
	if( $_SESSION['mysession'] ) {
		$_SESSION = [];
		session_unset();
		session_destroy();

		// akhiri cookie
		setcookie('id', '', time()-3600 );
		setcookie('key', '', time()-3600 );
	}
*/
	header('Location: index.php');
	exit;

?>

<?php include('includes/scripts.php'); ?>