<?php 

  require 'session.php';

  include('includes/header.php'); 
  include('includes/navbar.php');
  require 'function.php';

  $id = $_GET["id"];
  $table = query("SELECT * FROM produk WHERE id_produk = $id")[0];

  // cek apakah tombol submit sudah ditekan atau belum
  if( isset($_POST["save"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if ( product_edit($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data produk berhasil diubah!');
          document.location.href = 'products.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data produk gagal diubah!');
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
      <h6 class="m-0 font-weight-bold text-primary"> Edit Product Data
      </h6>
    </div>

    <div class="card-body">


      <!-- Form edit data -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <input type="hidden" name="id_produk" value="<?= $table["id_produk"];?>" >
          <input type="hidden" name="fotoLama" value="<?= $table["foto"];?>" >
          
          <div class="form-group">
            <label for="namaProduk">Nama Produk</label>
            <input type="text" class="form-control" name="namaProduk" id="namaProduk" placeholder="input nama produk" value="<?= $table["nama_produk"];?>" required>
          </div>

          <?php
          $row2 = query("SELECT kategori.id_cat, kategori.nama_kategori, produk.id_kategori FROM kategori, produk WHERE kategori.id_cat = produk.id_kategori");
          $row3 = query("SELECT * FROM kategori");
          $j = count($row3);
          ?>

          <div class="form-group">
            <label for="idKategori">Kategori</label>
            <select id="idKategori" name="idKategori" class="form-control" required>
              <option value="<?=$table['id_kategori']?>" >Pilih</option>
              <?php for($i=0; $i<$j; $i++):?>
                <option value="<?=$row3[$i]['id_cat']?>"> <?= $row3[$i]["nama_kategori"];?> </option>
              <?php endfor;?>            
            </select>
          </div>

          <div class="form-group">
            <label for="foto">Upload Gambar</label>
            <input type="file" class="form-control-file" name="foto" id="foto">
            <img class="mt-3" src="../assets/img/product/<?= $table["foto"];?>" width="90" > <br>
          </div>


          <div class="form-row">
            <div class="form-group col-2">
              <label for="warna">Warna</label>
              <input type="text" class="form-control" name="warna" id="warna" placeholder="input warna" value="<?= $table["warna"];?>" required> 
            </div>

            <div class="form-group col-3">
              <label for="ukuran">Ukuran</label>
              <input type="text" class="form-control" name="ukuran" id="ukuran" placeholder="input size" value="<?= $table["ukuran"];?>" required> 
            </div>

            <div class="form-group col-3">
              <label for="stok">Stok</label>
              <input type="text" class="form-control" name="stok" id="stok" placeholder="input stock" value="<?= $table["stok"];?>" required> 
            </div>
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control col-3" name="harga" id="harga" placeholder="input harga" value="<?= $table["harga"];?>" required>
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea type="text" class="form-control mb-3" id="deskripsi" name="deskripsi" rows="4" value="<?= $table["deskripsi_produk"];?>"><?= $table["deskripsi_produk"];?></textarea>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="save" id="save" class="btn btn-success">Save</button>
          <a href="products.php">
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