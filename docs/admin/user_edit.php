<?php 

  require 'session.php';

  include('includes/header.php'); 
  include('includes/navbar.php');
  require 'function.php';

  $id = $_GET["id"];
  $table = query("SELECT * FROM anggota WHERE id_anggota = $id")[0];

  // cek apakah tombol submit sudah ditekan atau belum
  if( isset($_POST["save"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if ( user_edit($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data user berhasil diubah!');
          document.location.href = 'users.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data user gagal diubah!');
          document.location.href = 'users.php';
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
      <h6 class="m-0 font-weight-bold text-primary"> Edit Product Data
      </h6>
    </div>

    <div class="card-body">


      <!-- Form edit data -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <input type="hidden" name="id" value="<?= $table["id_anggota"];?>" >
          <input type="hidden" name="fotoLama" value="<?= $table["foto"];?>" >
          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control col-3" type="text" placeholder="<?= $table["username"];?>" readonly>
          </div>
          
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control col-6" name="email" id="email" placeholder="Input email" value="<?= $table["email"];?>" required>
          </div>

          <div class="form-group">
            <label for="foto">Upload Gambar</label>
            <input type="file" class="form-control-file" name="foto" id="foto">
            <img class="mt-3" src="../assets/img/member/<?= $table["foto"];?>" width="90" > <br>
          </div>

          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control col-6" name="nama" id="nama" placeholder="Input name" value="<?= $table["nama"];?>" required>
          </div>

          <div class="form-group">
            <label for="ttl">Tanggal Lahir</label>
            <input type="date" class="form-control col-4" name="ttl" id="ttl" placeholder="Input date" value="<?= $table["tgl_lahir"];?>" required>
          </div>

          <div class="form-group">
            <label for="address">Alamat</label>
            <textarea type="text" class="form-control mb-3 col-6" id="address" name="address" rows="4" value="<?= $table["alamat"];?>" placeholder="Input address"><?= $table["alamat"];?></textarea>
          </div>

          <div class="form-row">
            <div class="form-group col-2">
              <label for="country">Negara</label>
              <select id="country" name="country" class="form-control">
                <option value="ID">Indonesia</option>
                <option value="SG">Singapore</option>
              </select>
            </div>

            <div class="form-group col-3">
              <label for="currency">Mata Uang</label>
              <select id="currency" name="currency" class="form-control">
                <option value="Rupiah">Rupiah</option>
                <option value="SGD">SGD</option>
              </select>
            </div>

            <div class="form-group col-3">
              <label for="telp">Telepon</label>
              <input type="text" class="form-control" name="telp" id="telp" placeholder="Input phone number" value="<?= $table["no_telp"];?>" required> 
            </div>
          </div>

          <input type="hidden" name="password" value="<?= $table["password"] ?>">
          <div class="form-group">
              <label for="edit_password">New Password</label>
              <input type="password" name="edit_password" class="form-control" id="edit_password" placeholder="Input password" value="<?=$table["password"];?>" required="">
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
          <a href="users.php">
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