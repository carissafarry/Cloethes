<?php 
	require 'session.php';
	require 'function.php';

	include('includes/header.php'); 
	include('includes/navbar.php'); 

	$table = query("SELECT * FROM anggota");

	// Notifikasi tambah data berhasil
	if( isset($_POST["submit"]) ) { 
		if( adduser($_POST) > 0 ) {
	      echo "<script>
					alert('Data user berhasil ditambahkan!');
					document.location.href = 'users.php';
				 </script>";
	    } else {
	      echo "<script>
					alert('Data user gagal ditambahkan!');
					document.location.href = 'users.php';
				 </script>";
	    }
	}


	// notifikasi hapus data page
	if( isset($_POST["delete"]) ) {
		if( deleteuser($_POST) > 0 ) {
			// menggunakan javascript untuk menampilkan notifikasi
			echo "
				<script>
					alert('Data berhasil dihapus!');
					document.location.href = 'users.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Data gagal dihapus!');
					document.location.href = 'users.php';
				</script>
			";
		}
	}


	// tangkap dan simpan data dari fungsi "data()" pada script ajax di bawah
	if( isset($_POST["search_data"]) ) { 
		userschosen_status($_POST);
	}

	if( isset($_POST["deletechosen"])) {
		if ( userschosen_delete($_POST) ) {
			echo "
				<script>
					alert('Data yang terpilih berhasil dihapus!');
					document.location.href = 'users.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Data yang terpilih gagal dihapus!');
					document.location.href = 'users.php';
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
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

        	<!-- Tabel tambah data user -->
        	<div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>

            <div class="form-group">
		      <label for="foto">Upload Foto</label>
		      <input type="file" class="form-control-file" name="foto" id="foto">
		    </div>

		    <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="ttl">Tanggal Lahir</label>
                <input type="date" name="ttl" class="form-control" id="ttl" placeholder="Enter born date" required>
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="Enter address">
            </div>

            <div class="form-group">
                <label for="country">Negara</label>
                <select id="country" name="country" class="form-control">
	              <option value="ID">Indonesia</option>
	              <option value="SG">Singapore</option>
	          	</select>
            </div>

            <div class="form-group">
                <label for="dollar">Mata Uang</label>
                <select id="currency" name="currency" class="form-control">
	              <option value="Rupiah">Rupiah</option>
	              <option value="SGD">SGD</option>
	          	</select>
            </div>

            <div class="form-group">
                <label for="telp">No Telp</label>
                <input type="text" name="telp" class="form-control" id="telp" placeholder="Enter phone number">
            </div>

            <div class="form-row">
	            <div class="form-group col-6">
	                <label for="password">Password</label>
	                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
	            </div>

	            <div class="form-group col-6">
	                <label for="password2">Confirm Password</label>
	                <input type="password" name="password2" class="form-control" id="password" placeholder="Enter confirm password" required>
	            </div>
            </div>

            <input type="hidden" name="usertype" value="user" >

        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<button type="submit" name="submit" class="btn btn-primary">Add User</button>
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
	    <h6 class="m-0 font-weight-bold text-primary"> USER DATA

	    	<form action="" method="post" class="mt-0">
	    	  <button type="submit" name="deletechosen" id="deletechosen" class="btn btn-danger ml-3" data-toggle="modal" style="float: right;">
	              Delete Chosen Data
	          </button>
	        </form>
	        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="float: right;"> Add User
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
				<th>User ID</th>
				<th>Username</th>
				<th>Email</th>
		        <th>Password</th>
		        <th>Foto</th>
		        <th>Nama</th>
		        <th>Tgl Lahir</th>
		        <th>Alamat</th>
		        <th>Negara</th>
				<th>Mata Uang</th>
				<th>Telepon</th>
				<th>Action</th>
	          </tr>
	        </thead>
	        <tbody>

	          <?php $i = 1; ?>
			  <?php foreach ( $table as $row ) : ?>
			  <tr>
				<td><?= $i; ?></td>
				<td><?= $row["id_anggota"]; ?></td>
				<td><?= $row["username"]; ?></td>
				<td><?= $row["email"]; ?></td>
				<td>***</td>
				<td><img src="../assets/img/member/<?= $row["foto"]; ?>" width="40"></td>
				<td><?= $row["nama"]; ?></td>
				<td><?= $row["tgl_lahir"]; ?></td>
				<td><?= $row["alamat"]; ?></td>
				<td><?= $row["negara"]; ?></td>
				<td><?= $row["mata_uang"]; ?></td>
				<td><?= $row["no_telp"]; ?></td>
				
				<!-- yang belum diedit : -->
	            <td>
	                <form action="" method="post" enctype="multipart/form-data">
	                	<!-- kirim data yang sudah dichecklist ke script ajax, dan tampilkan di layar data yg telah terchecklist dengan checkbox yg jg telah terchecklist -->

	                	<input type="checkbox" class="mr-2" name="chosen" id="chosen" value="<?= $row["id_anggota"];?>" onclick="toggleCheckbox(this)" 
	                	<?= $row["status"] == 1 ? "checked" : "" ?>
	                	> 


	                    <input type="hidden" name="edit" value="">
	                    <a class="btn btn btn-success btn-sm rounded-0" name="edit" href="user_edit.php?id= <?= $row["id_anggota"];?>" >EDIT</a>
	              

	                    <input type="hidden" name="id" value="<?= $row["id_anggota"];?>" >
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
			url: "users.php",

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
