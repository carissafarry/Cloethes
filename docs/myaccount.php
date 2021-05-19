<?php 

	require_once 'session.php';
	require_once 'function.php';
/*
	if( isset($_SESSION["cloethes"]) ) {
    if (isset($_SESSION["api_login"]) ) {
      header("Location: myaccount.php");
      exit;
    }
	} else {
    header("Location: login.php");
    exit;
  }
  */

  if (isset($_SESSION['cloethes']) ) {
    $user = $_SESSION['cloethes'];
    if (isset($_SESSION["api_login"]) ) {
      header("Location: orders.php");
      exit();

    } else {
      $table = query("SELECT * FROM anggota WHERE username = '$user'")[0];
    }
  } else {
    header("Location: login.php");
    exit();
  }
  


  // cek apakah tombol submit sudah ditekan atau belum
  if( isset($_POST["save"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if ( user_edit($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data user berhasil diubah!');
          document.location.href = 'myaccount.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data user gagal diubah!');
          document.location.href = 'myaccount.php';
        </script>
      ";
    }
  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/myaccount.css">

    
  <title>c l o e t h e s</title>
  <link href="assets/img/page/logo.png" rel="shortcut icon">

</head>

<marquee onmouseover="this.stop()" onmouseout="this.start()" > <a href="products.php" class="link">
  <span>
    free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
  </span>
  <span>
    free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
  </span>
</a> </marquee>


<?php include 'includes/navbar.php'; ?>
<body>


  
  <div class="container">
    <div class="row row-myaccount">

      <?php 
      	include_once 'includes/myaccount-navbar.php';
      ?>

      <div class="col-md-8 cart-data">

      <!-- Form my account -->
        <form class="edit-account" action="" method="post">

          <div class="row input-form">

            <input type="hidden" name="id" value="<?= $table["id_anggota"];?>" >

            <div class="form-group form-row-first">
              <label for="username">Username</label>
              <input class="form-control form-input" type="text" name="username" id="username" placeholder="<?= $table["username"];?>" readonly>
            </div>


            <div class="form-group form-row-last">
              <label for="email">Email</label>
              <input class="form-control form-input" type="text" name="email" id="email" placeholder="<?= $table["email"];?>" readonly>
            </div>

          </div>

          <div class="row input-form">

            <div class="form-group form-row-first">
              <label for="name">Nama</label>
              <input class="form-control form-input" type="text" name="name" id="name" placeholder="Input name" value="<?= $table["nama"];?>" required>
            </div>


            <div class="form-group form-row-first">
              <label for="ttl">Tanggal Lahir</label>
              <input class="form-control form-input" type="date" name="ttl" id="ttl" placeholder="Input date" value="<?= $table["tgl_lahir"];?>" required>
            </div>

          </div>


          <div class="row input-form">

            <div class="form-group form-row-first">
              <label for="address">Alamat</label>
              <input class="form-control form-input" type="text" name="address" id="address" placeholder="Input address" value="<?= $table["alamat"];?>" required>
            </div>

          </div>

          <p>
            <button type="submit" class="btn-edit" name="save" value="Save Changes"> Save changes
              
            </button>
          </p>
        </form>

        

      </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>
<?php include('includes/scripts.php'); ?>

  </body>

<script>

</script>

</html>