<?php 

  session_start();

  include('includes/header.php'); 
  include('includes/navbar.php');
  require 'function.php';

  $id = $_GET["id"];
  $table = query("SELECT * FROM user_admin WHERE id_admin = $id")[0];

  // cek apakah tombol submit sudah ditekan atau belum
  if( isset($_POST["save"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if ( edit($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data Admin berhasil diubah!');
          document.location.href = 'register.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data gagal diubah!');
          document.location.href = 'register.php';
        </script>
      ";
    }
  }
?>




<!-- Container Fluid -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Edit Admin Profile 
      </h6>
    </div>

    <div class="card-body">


      <!-- Form edit data -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <input type="hidden" name="id_admin" value="<?= $table["id_admin"];?>" >

          <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="edit_username" class="form-control" id="edit_username" placeholder="Enter Username" value="<?=$table["username"];?>">
          </div><!--
          <div class="form-group">
              <label for="password2">Current Password</label>
              <input type="text" name="password2" class="form-control" id="password2" placeholder="Enter current password" >
          </div>-->

          <input type="hidden" name="password" value="<?= $table["password"] ?>">

          <div class="form-group">
              <label for="password">New Password</label>
              <input type="password" name="edit_password" class="form-control" id="edit_password" placeholder="Enter Password" required="">
          </div>
          <div class="form-group">
              <label for="usertype">Usertype</label>
              <select name="usertype" class="form-control col-sm-2">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
          <a href="register.php">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </a>
        </div>
      </form>


      </div>
    </div>
  </div>
</div>
<!-- ./Container Fluid -->

<?php
  include('includes/scripts.php');
  include('includes/footer.php');

?>