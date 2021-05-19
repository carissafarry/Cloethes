<?php 
  require_once 'session.php';
  require_once 'function.php';
  require_once 'database/dbconfig.php';

  include_once('includes/header.php'); 
  include_once('includes/navbar.php'); 
  
  if ( !isset($_GET["keyword"]) ) {
    header("Location: index.php");
    exit();
  }

  $keyword = $_GET["keyword"];
  $table = query("
    SELECT * FROM produk 
    LEFT OUTER JOIN kategori
    ON produk.id_kategori = kategori.id_cat
    WHERE nama_produk LIKE '%$keyword%'
    OR deskripsi_produk LIKE '%$keyword%'
    OR warna LIKE '%$keyword%'
    OR nama_kategori LIKE '%$keyword%'
  ");


  // notifikasi hapus data produk
  if( isset($_POST["delete"]) ) {
    if( productdelete($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data berhasil dihapus!');
          document.location.href = 'products.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data gagal dihapus!');
          document.location.href = 'products.php';
        </script>
      ";
    }
  }


  // tangkap dan simpan data dari fungsi "data()" pada script ajax di bawah
  if( isset($_POST["search_data"]) ) { 
    productchosen_status($_POST);
  }

  if( isset($_POST["deletechosen"])) {
    if ( productchosen_delete($_POST) ) {
      echo "
        <script>
          alert('Data yang terpilih berhasil dihapus!');
          document.location.href = 'products.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data yang terpilih gagal dihapus!');
          document.location.href = 'products.php';
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
      <h6 class="m-0 font-weight-bold text-primary">SEARCHING RESULT
      </h6>
    </div>

    <div class="card-body">

      <!-- Tabel Data -->
      <div class="table-responsive">


        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>NO</th>
              <th>ID Produk</th>
              <th>Kategori</th>
              <th>Nama Produk</th>
              <th>Gambar</th>
              <th>Warna</th>
              <th>Ukuran</th>
              <th>Stok</th>
              <th>Harga</th>
              <th style="width: 20%;">Deskripsi</th>
             <th>Action</th>
            </tr>
          </thead>
          <tbody>

        <?php $i = 1; ?>
        <?php foreach ( $table as $row ) : 
          $id_kat = $row["id_kategori"];
          $table2 = query("
          SELECT * FROM kategori
          WHERE id_cat = '$id_kat'
          ")[0];
              ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $row["id_produk"]; ?></td>
              <td><?= $table2["nama_kategori"]; ?></td>
              <td><?= $row["nama_produk"]; ?></td>
              <td><img src="../assets/img/product/<?= $row["foto"]; ?>" width="40"></td>
              <td><?= $row["warna"]; ?></td>
              <td><?= $row["ukuran"]; ?></td>
              <td><?= $row["stok"]; ?></td>
              <td>Rp. <?= $row["harga"]; ?>,00</td>
              <td><?= $row["deskripsi_produk"]; ?></td>

            <!-- yang belum diedit : -->
              <td>
                <form action="" method="post" enctype="multipart/form-data">

                <!-- kirim data yang sudah dichecklist ke script ajax, dan tampilkan di layar data yg telah terchecklist dengan checkbox yg jg telah terchecklist -->

                  <input type="checkbox" class="mr-2" name="chosen" id="chosen" value="<?= $row["id_produk"];?>" onclick="toggleCheckbox(this)" 
                  <?= $row["status"] == 1 ? "checked" : "" ?>
                  > 

                    <input type="hidden" name="edit" value="">
                    <a class="btn btn btn-success btn-sm rounded-0" name="edit" href="product_edit.php?id= <?= $row["id_produk"];?>" >EDIT</a>
              

                    <input type="hidden" name="id" value="<?= $row["id_produk"];?>" >
                    <button type="submit" name="delete" class="btn btn-secondary btn-sm rounded-0" onclick="return confirm('Yakin hapus data ini?');" >DELETE</button>
                </form>
              </td>
            </tr>
          <?php $i++; ?>
      <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
<!-- ./Container Fluid -->




<?php
include('includes/scripts.php');
include('includes/footer.php');

?>
