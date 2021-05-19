<?php 
	require 'session.php';
	
	include('includes/header.php'); 
	include('includes/navbar.php');
	require 'function.php';

	$table = query("SELECT * FROM kategori");

	
	// Notifikasi tambah data berhasil
	if( isset($_POST["addcategory"]) ) { 
		if( addcategory($_POST) > 0 ) {
	      echo "<script>
					alert('Kategori berhasil ditambahkan!');
					document.location.href = 'categories.php';
				 </script>";
	    } else {
	      echo "<script>
					alert('Kategori tidak berhasil ditambahkan!');
					document.location.href = 'categories.php';
				 </script>";
	    }
	}

	// notifikasi hapus data page
	if( isset($_POST["delete"]) ) {
		if( categories_delete($_POST) > 0 ) {
			// menggunakan javascript untuk menampilkan notifikasi
			echo "
				<script>
					alert('Data berhasil dihapus!');
					document.location.href = 'categories.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Data gagal dihapus!');
					document.location.href = 'categories.php';
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
        <h5 class="modal-title" id="exampleModalLabel">Add Page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST">
        <div class="modal-body">

        	<!-- Tabel tambah data halaman about us -->
        	<div class="form-group">
                <label for="name_cat">Category Name</label>
                <input type="text" name="name_cat" class="form-control" id="pagename" placeholder="Input name">
            </div>
            <div class="form-group">
                <label for="desc_cat">Description</label>
                <input type="text" name="desc_cat" class="form-control" id="desc_cat" placeholder="Input description">
            </div>

        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<button type="submit" name="addcategory" class="btn btn-primary">Add Category</button>
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
	    <h6 class="m-0 font-weight-bold text-primary"> CATEGORIES
	            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="float: right;">
	              Add Categories
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
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Action</th>
	          </tr>
	        </thead>
	        <tbody>

	          <?php $i = 1; ?>
			  <?php foreach ( $table as $row ) : ?>
			  <tr>
				<td><?= $i; ?></td>
				<td><?= $row["id_cat"]; ?></td>
				<td><?= $row["nama_kategori"]; ?></td>
				<td><?= $row["deskripsi_kategori"]; ?></td>

				<!-- yang belum diedit : -->
	            <td>
	                <form action="" method="post" enctype="multipart/form-data">
	                    <input type="hidden" name="edit" value="">
	                    <a class="btn btn btn-success btn-sm rounded-0" name="edit" href="categories_edit.php?id= <?= $row["id_cat"];?>" >EDIT</a>
	              

	                    <input type="hidden" name="id" value="<?= $row["id_cat"];?>" >
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