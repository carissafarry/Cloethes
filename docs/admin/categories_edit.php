<?php 

  require 'session.php';

  include('includes/header.php'); 
  include('includes/navbar.php');
  require 'function.php';
  
  $id = $_GET["id"];
  $table = query("SELECT * FROM kategori WHERE id_cat = $id")[0];

  // cek apakah tombol submit sudah ditekan atau belum
  if( isset($_POST["save"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if ( category_edit($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data page berhasil diubah!');
          document.location.href = 'categories.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data page gagal diubah!');
          document.location.href = 'categories_edit.php';
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
      <h6 class="m-0 font-weight-bold text-primary"> Edit Category
      </h6>
    </div>

    <div class="card-body">


      <!-- Form edit data -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <input type="hidden" name="id_cat" value="<?= $table["id_cat"];?>" >

          <div class="form-group">
              <label for="name_cat">Nama Kategori</label>
              <input type="text" name="name_cat" class="form-control" id="title" placeholder="Input category" value="<?=$table["nama_kategori"];?>">
          </div>

          <div class="form-group">
              <label for="desc_cat">Description</label>
              <input type="text" name="desc_cat" class="form-control" id="desc" placeholder="Input description" value="<?=$table["deskripsi_kategori"];?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
          <a href="categories.php">
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