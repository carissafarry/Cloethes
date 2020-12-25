<?php 

  require 'session.php';

  include('includes/header.php'); 
  include('includes/navbar.php');
  require 'function.php';

  $id = $_GET["id"];
  $table = query("SELECT * FROM about_us WHERE id_page = $id")[0];

  // cek apakah tombol submit sudah ditekan atau belum
  if( isset($_POST["save"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if ( aboutus_edit($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data page berhasil diubah!');
          document.location.href = 'aboutus.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data page gagal diubah!');
          document.location.href = 'aboutus.php';
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
      <h6 class="m-0 font-weight-bold text-primary"> Edit About Us Page
      </h6>
    </div>

    <div class="card-body">


      <!-- Form edit data -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <input type="hidden" name="id_page" value="<?= $table["id_page"];?>" >

          <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Input title" value="<?=$table["title"];?>">
          </div>

          <div class="form-group">
              <label for="desc">Description</label>
              <input type="text" name="desc" class="form-control" id="desc" placeholder="Input description" value="<?=$table["desc_page"];?>">
          </div>

          <div class="form-group">
              <label for="link">Link</label>
              <input type="text" name="link" class="form-control" id="link" placeholder="Input link" value="<?=$table["link"];?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
          <a href="aboutus.php">
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