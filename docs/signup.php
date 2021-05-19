<?php 

	require_once 'session.php';
	include_once 'api_config.php';
	require_once 'function.php';
	
	// konfigurasi untuk google api
	$login_button = '';
	if( isset($_GET["code"]) ) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);
		$_SESSION['access_token'] = $token;


		if( !isset($token['error']) ) {
			// mendapatkan profile info
			$gClient->setAccessToken( $token['access_token'] );

			$gService = new Google_Service_Oauth2($gClient);
			$data = $gService->userinfo->get();


			if ( isset($data) ) {
				//$_SESSION["cloethes"] = $data["given_name"];
				$_SESSION["api_login"] = $data["email"];
				$_SESSION["cloethes"] = $_SESSION["api_login"];

				// jika sudah pernah mengunjungi halaman lainnya sebelum login
			    header('Location: index.php');
				exit;
			}
		}
	}

	if( !isset($_SESSION['access_token']) ) {
		$login_button = 
		'<a href="'.$gClient->createAuthUrl().'">
		   <img src="https://img.icons8.com/ios/30/000000/google-plus.png"/>
		</a>';
	} else { 
	    header('Location: index.php');
		exit;
	}
//------------------------------------------------------//
	/*
	$loginURL = 
	'<a href="'.$gClient->createAuthUrl().'">
	   <img src="https://img.icons8.com/ios/30/000000/google-plus.png"/>
	</a>';


	if ( isset($_SESSION['access_token']) ) {
		$gClient->setAccessToken($_SESSION['access_token']);
	} else if( isset($_GET['code']) ) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: login.php');
		exit;
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

	$_SESSION['id'] = $userData['id'];
	$_SESSION['email'] = $userData['email'];
	$_SESSION['gender'] = $userData['gender'];
	$_SESSION['picture'] = $userData['picture'];
	$_SESSION['familyName'] = $userData['familyName'];
	$_SESSION['givenName'] = $userData['givenName'];

	header('Location: index.php');
	exit;
*/
 // --------------------------------------------------------------------------- //
	// cek cookie bila pernah login di perangkat yang sama
	if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
		$id = $_COOKIE['id'];
		$key = $_COOKIE['key'];

		// cek apakah username dari input user sama dengan di data username
		// ambil username bersadarkan id
		$result = mysqli_query($conn, "SELECT username FROM anggota WHERE id_anggota = $id");
		$row = mysqli_fetch_assoc($result); // $row hanya berisi baris dari kolom data yang terdapat username yang cocok

		// cek cookie dan username
		if( $key === hash('sha256', $row['username']) ) { 
			$_SESSION['mysession'] = $row['username'];
			$_SESSION['cloethes'] = $_SESSION['mysession'];
		    header('Location: index.php');
			exit;
		}
	}

	// jika telah login, pindah ke index.php
	if( isset($_SESSION["mysession"]) ) {
		header('Location: index.php');
		exit;
	}


	// cek bila belum ada cookie, atau login di perangkat baru
	if( isset($_POST["login"]) ) {
		//var_dump($_POST);
		$username = $_POST["username"];
		$password = $_POST["password"];
		

		// cek apakah user menginput username yang benar dg data
		$result = mysqli_query($conn, "SELECT * FROM anggota WHERE username = '$username'");

		// cek username
		if( mysqli_num_rows($result) === 1 ) { // jika baris yang dikembalikan dari $result = 1, maka username sama/sesuai
			$row = mysqli_fetch_assoc($result); // mengambil baris dengan data username yg sesuai
			// cek password
			if( $password === $row["password"] ) {
				// jika berhasil login, set session (BUAT SESSION)
				// buat variabel session bernama log in
				
				//$_SESSION["cloethes"] = $row['username'];

				$_SESSION["mysession"] = $row['username'];
				$_SESSION["cloethes"] = $_SESSION["mysession"];

/*
				// cek remember me
				if( isset($_POST['remember']) ) { // jika terchecklist

					// buat cookie id dan username
					setcookie('id', $row['id_anggota'], time()+60 ); // berlaku semenit
					setcookie('key', $row['username'], time()+60 ); // 
				}

*/
				// jika sudah pernah mengunjungi halaman lainnya sebelum login
				/*
			    if( $redirect_to != '' ) {
			        header('Location: '.$redirect_to);
			    } else {
			        header('Location: index.php');
			    }*/
			    header('Location: index.php');
				exit;

/*
				// cek halaman yang dikunjungi user sebelum hal. login
				if( $redirect_to != '' ) {
					header("Location: ".$redirect_to);
					exit;
				} else {
					header("Location: index.php");
					exit;
				}
*/
			}
		}
		$error = true;
	}
	// menggunakan javascript untuk menampilkan notifikasi
	if ( isset($error) ) {
      echo "
        <script>
          alert('Username atau password salah!');
          document.location.href = 'login.php';
        </script>
      ";
    } 
?>


<!DOCTYPE html>
<html>
<head>

	<?php include('includes/header.php'); ?>
	<link rel="stylesheet" href="css/login.css">

	<title>c l o e t h e s</title>
  	<link href="assets/img/page/logo.png" rel="shortcut icon">
	
	<!-- SCSS FILE -->
	<link href="scss/login.scss" rel="stylesheet/scss" type="text/css">

</head>
<body>

<?php include 'includes/navbar.php'; ?>

  <!-- Login Form -->
  <div class="login-box ml-0">
  	<h1>Login</h1>
  	<form action="" method="post" enctype="multipart/form-data">
  	<div class="textbox">
  		<img src="https://img.icons8.com/windows/23/000000/user.png"/>
  		<input type="text" class="username" placeholder="Username" name="username" >
  	</div>

  	<div class="textbox password-box">
  		<img src="https://img.icons8.com/windows/21/000000/password1.png"/>
  		<input type="password" class="password" placeholder="Password" name="password" >

  		<input type="hidden" name="redirect_to" value="<?= $redirect_to ?>">

  		<button type="submit" name="login" class="login_button" >
        	<img src="assets/img/page/arrow.svg" class="arrow" />
        </button>

    <!--
  		<img src="assets/img/page/arrow.svg" type="submit" class="arrow" name="logIn" />
  	-->
  	</div>
  	</form>

  	<ul class="list-inline social-buttons">
  	  <li class="list-inline-item">
  		<p><a href="signup.php" class="link">Create my new account now.</a></p>
  	  </li>
      <li class="list-inline-item sosmed">
        <a href="signup.php">
          <img src="https://img.icons8.com/ios-filled/25/000000/facebook-new.png" />
        </a>
      </li>
      <li class="list-inline-item sosmed">
  	  <?php 
  		if ($login_button == '') {
  	  	//if ($loginURL == '') {
  	  	//echo $loginURL;  
  	  	  echo "
          <script>
          	alert('Berhasil masuk!');
          	document.location.href = 'login.php';
          </script>
      	  ";
  	  	} else {
  	  		echo "$login_button";
  	  		//echo $loginURL;
  		}
  			//echo $loginURL;
	  ?>

        
      </li>
    </ul>
  </div>
  <!-- Akhir Login Form -->
 

</body>

<?php include('includes/scripts.php'); ?>

</html>