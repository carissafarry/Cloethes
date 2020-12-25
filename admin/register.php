<?php 
	require 'session.php';
	require 'function.php';

	include('includes/header.php'); 
	include('includes/navbar.php'); 
	
	$table = query("SELECT * FROM user_admin");

	// Notifikasi tambah data berhasil
	if( isset($_POST["register"]) ) { // ketika tombol register dipencet
		if( registrasi_admin($_POST) > 0 ) { // jalankan fungsi registrasi
			echo "
		        <script>
		          alert('Admin berhasil ditambahkan!');
		          document.location.href = 'register.php';
		        </script>
		      ";
		} else {
			echo "
		        <script>
		          alert('Admin gagal ditambahkan!');
		          document.location.href = 'register.php';
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
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

        	<!-- Tabel tambah data user admin -->
        	<div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" name="password2" class="form-control" id="password2" placeholder="Confirm Password">
            </div>
            <div class="form-group">
              <label for="usertype">Usertype</label>
              <select name="usertype" class="form-control col-sm-3">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
          	</div>
            	

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="register" class="btn btn-primary">Save</button>
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
	    <h6 class="m-0 font-weight-bold text-primary"> ADMIN PROFILE DATA
	            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="float: right;">
	              Add Admin Profile 
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
				<th>Username</th>
				<th>Password</th>
				<th>Usertype</th>
				<th>Action</th>
	          </tr>
	        </thead>
	        <tbody>

	          <?php $i = 1; ?>
			  <?php foreach ( $table as $row ) : ?>
			  <tr>
				<td><?= $i; ?></td>
				<td><?= $row["id_admin"]; ?></td>
				<td><?= $row["username"]; ?></td>
				<td> *** </td>
				<td><?= $row["usertype"]; ?></td>

				<!-- yang belum diedit : -->
	            <td>
	                <form action="" method="post">
	                    <input type="hidden" name="edit" value="">
	                    <a class="btn btn btn-success btn-sm rounded-0" name="edit" href="edit.php?id= <?= $row["id_admin"];?>" >EDIT</a>
	                
	                  <input type="hidden" name="delete" value="">
	                    <a class="btn btn btn-secondary btn-sm rounded-0" name="delete" href="delete.php?id= <?= $row["id_admin"];?>" onclick="return confirm('Yakin hapus data ini?');" >DELETE</a>
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
