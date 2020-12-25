<?php 
	require 'session.php';
	require 'function.php';

	include('includes/header.php'); 
	include('includes/navbar.php'); 

	$table = query("SELECT * FROM about_us");

	// Notifikasi tambah data berhasil
	if( isset($_POST["addpage"]) ) { 
		if( addpage($_POST) > 0 ) {
	      echo "<script>
					alert('Halaman berhasil ditambahkan!');
					document.location.href = 'aboutus.php';
				 </script>";
	    } else {
	      echo "<script>
					alert('Halaman tidak berhasil ditambahkan!');
					document.location.href = 'aboutus.php';
				 </script>";
	    }
	}


	// notifikasi hapus data page
	if( isset($_POST["delete"]) ) {
		if( pagedelete($_POST) > 0 ) {
			// menggunakan javascript untuk menampilkan notifikasi
			echo "
				<script>
					alert('Data berhasil dihapus!');
					document.location.href = 'aboutus.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Data gagal dihapus!');
					document.location.href = 'aboutus.php';
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
                <label for="pagename">Username Page</label>
                <input type="text" name="pagename" class="form-control" id="pagename" placeholder="Input title">
            </div>
        	<div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Input title">
            </div>
            <div class="form-group">
                <label for="desc_page">Deskripsi</label>
                <input type="text" name="desc_page" class="form-control" id="desc_page" placeholder="Input description">
            </div>
            <div class="form-group">
                <label for="page_link">Link</label>
                <input type="text" name="page_link" class="form-control" id="page_link" placeholder="Input link">
            </div>  	

        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<button type="submit" name="addpage" class="btn btn-primary">Add Page</button>
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
	    <h6 class="m-0 font-weight-bold text-primary"> ABOUT OUR COMPANY
	            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="float: right;">
	              Add Page
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
				<th>Page Username</th>
				<th>Title</th>
				<th>Description</th>
				<th>Links</th>
				<th>Action</th>
	          </tr>
	        </thead>
	        <tbody>

	          <?php $i = 1; ?>
			  <?php foreach ( $table as $row ) : ?>
			  <tr>
				<td><?= $i; ?></td>
				<td><?= $row["id_page"]; ?></td>
				<td><?= $row["pagename"]; ?></td>
				<td><?= $row["title"]; ?></td>
				<td><?= $row["desc_page"]; ?></td>
				<td><?= $row["link"]; ?></td>

				<!-- yang belum diedit : -->
	            <td>
	                <form action="" method="post" enctype="multipart/form-data">
	                    <input type="hidden" name="edit" value="">
	                    <a class="btn btn btn-success btn-sm rounded-0" name="edit" href="aboutus_edit.php?id= <?= $row["id_page"];?>" >EDIT</a>
	              

	                    <input type="hidden" name="id" value="<?= $row["id_page"];?>" >
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