<?php 
	require_once 'session.php';
	require_once 'function.php';

	include_once('includes/header.php'); 
	include_once('includes/navbar.php'); 

	$table = query("SELECT * FROM produk");

	// Notifikasi tambah data berhasil
	if( isset($_POST["submit"]) ) { 
		if( addproduct($_POST) > 0 ) {
	      echo "<script>
					alert('Data produk berhasil ditambahkan!');
					document.location.href = 'products.php';
				 </script>";
	    } else {
	      echo "<script>
					alert('Data produk gagal ditambahkan!');
					document.location.href = 'products.php';
				 </script>";
	    }
	}


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

<!-- Container -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

        	<!-- Tabel tambah data halaman about us -->
        	<div class="form-group">
	          <label for="namaProduk">Nama Produk</label>
	          <input type="text" class="form-control" name="namaProduk" id="namaProduk" placeholder="input nama produk" required>
	        </div>

        	<div class="form-group">
	          <label for="idKategori">Kategori</label>
	          <select id="idKategori" name="idKategori" class="form-control" required>
	            <option selected>Pilih</option>
	            <?php 
	              $row2 = query("SELECT * FROM kategori");
	              $j = count($row2);
	              for($i=0; $i<$j; $i++):?>
	                <option value="<?=$row2[$i]['id_cat']?>" ><?= $row2[$i]["nama_kategori"];?> </option>
	              <?php endfor;?>            
	          </select>
	        </div>

       		<div class="form-group">
		      <label for="foto">Upload Image</label>
		      <input type="file" class="form-control-file" name="foto" id="foto" required>
		    </div>

		    <div class="form-row">
		      <div class="form-group col">
		        <label for="warna">Warna</label>
		        <input type="text" class="form-control" name="warna" id="warna" placeholder="color" required>
		      </div>

		      <div class="form-group col">
		        <label for="ukuran">Ukuran</label>
		        <input type="text" class="form-control" name="ukuran" id="ukuran" placeholder="size" required>
		      </div>

		      <div class="form-group col">
		        <label for="stok">Stok</label>
		        <input type="text" class="form-control" name="stok" id="stok" placeholder="stock" required>
		      </div>
		    </div>

		    <div class="form-group">
		      <label for="harga">Harga</label>
		      <input type="text" class="form-control col-3" name="harga" id="harga" placeholder="input harga" required>
		    </div>

		    <div class="form-group">
		      <label for="">Deskripsi</label>
		      <textarea type="text" class="form-control mb-3" id="deskripsi" name="deskripsi" rows="4"></textarea>
		    </div> 	

        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<button type="submit" name="submit" class="btn btn-primary">Add Product</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Container Fluid -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
	    <h6 class="m-0 font-weight-bold text-primary"> PRODUCT DATA
	    	<form action="" method="post" class="mt-0">
	    	  <button type="submit" name="deletechosen" id="deletechosen" class="btn btn-danger ml-3" data-toggle="modal" style="float: right;">
	              Delete Chosen Data
	          </button>
	        </form>

	        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="float: right;"> Add Product
	        </button>
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
				<th>ID Kategori</th>
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




<?php include('includes/scripts.php'); ?>

<script>
	function toggleCheckbox(box) {
		// ambil nilai dari atribut value pada tag html yang dimaksud, yaitu bernilai id_produk
		var id = $(box).attr("value"); 

		// jika status dari data yang terceklist adalah benar "checked", maka memiliki nilai status = 1, jika tidak maka status = 0
		if( $(box).prop("checked") == true ) {
			var status = 1;
		} else {
			var status = 0;
		}

		// buat variabel data, dengan anggota array yaitu "search_data" yg bernilai 1, "id" yang bernilai id_produk dari atribut value, dan "status" yang mengambil nilai dari variabel status (dari field database produk)
		var data = {
			"search_data" : 1,
			"id_chosen" : id, // dari fungsi 'id' di atas
			"status": status //dari variabel status di atas
		};

		// tentukan metode dan tujuan data yang akan dikirim, serta status berhasil/tidaknya
		$.ajax( {
			type: "post",
			url: "products.php",

			// kirim data pada variabel "data" di atas, selanjutnya akan ditangkap oleh fungsi isset.
			data: data,

			// periksa apakah checklist sudah tersambung dengan ajax dan status database telah berubah
			success: function (response) {
				//alert("Data changed!");
			}
		} );
	}
</script>


<?php include('includes/footer.php'); ?>

