<?php
  session_start();
  require 'function.php';
  include('includes/header.php'); 


  // cek cookie bila pernah login di perangkat yang sama
  if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // cek apakah username dari input user sama dengan di data username
    // ambil username bersadarkan id
    $result = mysqli_query($conn, "SELECT username FROM user_admin WHERE id_admin = $id");
    $row = mysqli_fetch_assoc($result); // $row hanya berisi baris dari kolom data yang terdapat username yang cocok

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {  // 3 '=' agar sama persis
      $_SESSION['login'] = $row['username'];
    }
  }


  // jika telah login, pindah ke index.php
  if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
  }


  // cek bila belum ada cookie, atau login di perangkat baru
  if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    

    // cek apakah user menginput username yang benar dg data
    $result = mysqli_query($conn, "SELECT * FROM user_admin WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) { // jika baris yang dikembalikan dari $result = 1, maka username sama/sesuai

      $row = mysqli_fetch_assoc($result); // mengambil baris dengan data username yg sesuai

      // cek nilai usertype
      if( $row["usertype"] == "admin" ) {

        // cek password
        if( password_verify($password, $row["password"]) ) { // cek sebuah string apakah sama dengan hashnya

          // jika berhasil login, set session (BUAT SESSION)
           // buat variabel session bernama log in
          $_SESSION["login"] = $row['username'];

          // cek remember me
          if( isset($_POST['remember']) ) { // jika terchecklist

            // buat cookie id dan username
            setcookie('id', $row['id_admin'], time()+60 ); // berlaku semenit
            setcookie('key', hash('sha256', $row['username']), time()+60 ); // username dienkripsi
          }

          header("Location: index.php");
          exit;
        }
      }

      else if ($row["usertype"] == "user") {
        //$_SESSION["login"] = $row['username'];
        header("Location: ../login.php");
        exit;
      }

      else {
        $error = true;
      }
    }

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


<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center login-row" style="display: inherit;">

  <div class="col-md-3" style="margin-left: 27%; margin-top: 10%;">

    <div class="card o-hidden border-0 shadow-lg my-4 mt-4" style="width: 500px;">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row" style="display: grid;">
          <div class="d-none d-lg-block"></div>
            <div class="p-5" style="padding-left: 25%;">
              <div class="justify-text-center">
                <h1 class="h3 text-gray mb-4">Admin Login</h1>
              </div>

              <form action="" method="post" class="user">

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Enter your password">
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox small">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" >
                    <label class="custom-control-label" for="remember" >Remember Me</label>
                  </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-user btn-block">Login</button>
                </a>
              </form>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('includes/scripts.php'); 
?>