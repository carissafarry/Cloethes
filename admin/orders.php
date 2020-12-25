<?php 
	require 'session.php';
	require 'function.php';

	include('includes/header.php'); 
	include('includes/navbar.php'); 

	$table = query("SELECT * FROM order_data");
	

	// Notifikasi tambah data berhasil
	if( isset($_POST["submit"]) ) { 
		if( addproduct($_POST) > 0 ) {
	      echo "<script>
					alert('Data produk berhasil ditambahkan!');
					document.location.href = 'orders.php';
				 </script>";
	    } else {
	      echo "<script>
					alert('Data produk gagal ditambahkan!');
					document.location.href = 'orders.php';
				 </script>";
	    }
	}


	// notifikasi hapus data produk
	if( isset($_POST["delete"]) ) {
		if( order_delete($_POST) > 0 ) {
			// menggunakan javascript untuk menampilkan notifikasi
			echo "
				<script>
					alert('Data berhasil dihapus!');
					document.location.href = 'orders.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Data gagal dihapus!');
					document.location.href = 'orders.php';
				</script>
			";
		}
	}


	// tangkap dan simpan data dari fungsi "data()" pada script ajax di bawah
	if( isset($_POST["search_data"]) ) { 
		productchosen_status($_POST);
	}

	if( isset($_POST["deletechosen"])) {
		if ( orderchosen_delete($_POST) ) {
			echo "
				<script>
					alert('Data yang terpilih berhasil dihapus!');
					document.location.href = 'orders.php';
				</script>
			";
		} else {
			echo "
				<script>
					alert('Data yang terpilih gagal dihapus!');
					document.location.href = 'orders.php';
				</script>
			";
		}
	}
?>
<style>
	.@media print {
		.print-none {
			display: none;
		}
	}
</style>
<link rel="stylesheet" href="css/orders.css">

<!-- Container --
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Order Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

        	!-- Tabel tambah data halaman about us --
        	<div class="form-group">
	          <label for="id_anggota">ID User</label>
	          <input type="text" class="form-control" name="id_anggota" id="id_anggota" placeholder="Input id user" required>
	        </div>

	        <div class="form-group">
	          <label for="id_produk">ID Product</label>
	          <input type="text" class="form-control" name="id_produk" id="id_produk" placeholder="Input id produk" required>
	        </div>

	        <div class="form-group">
	          <label for="tgl_order">Order Date</label>
	          <input type="date" class="form-control" name="tgl_order" id="tgl_order" placeholder="Input order date" required>
	        </div>

	        <div class="form-group">
	          <label for="waktu">Time</label>
	          <input type="time" class="form-control" name="waktu" id="waktu" placeholder="Input time order" required>
	        </div>

		    <div class="form-group">
		      <label for="jml_order">Quantity</label>
		      <input type="text" class="form-control" name="jml_order" id="jml_order" value="1" required>
		    </div>

		    <div class="form-group">
		      <label for="total_payment">Total Payment</label>
		      <input type="text" class="form-control" name="total_payment" id="total_payment" placeholder="Input total payment" required>
		    </div>

        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<button type="submit" name="submit" class="btn btn-primary">Add Order Data</button>
        </div>
      </form>

    </div>
  </div>
</div>
-->

<!-- Container Fluid -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
	    <h6 class="m-0 font-weight-bold text-primary">ORDER DATA
	    	<form action="" method="post" class="mt-0">
	    	  <button type="submit" name="deletechosen" id="deletechosen" class="btn btn-danger ml-3 deletechosen print-none" data-toggle="modal" style="float: right;">
	              Delete Chosen Data
	          </button>
	        </form>
<!--
	        <button type="button" class="btn btn-primary print-none" data-toggle="modal" data-target="#addadminprofile" style="float: right;"> Add Data
	        </button>
-->

	        <a href="print.php">
		        <button type="button" class="btn btn-primary print-none print-btn"style="float: right;" target="blank"> Report
		        </button>
	        </a>
	    </h6>
	  </div>

	  <div class="card-body">

	  	<!-- Tabel Data -->
	    <div class="table-responsive">

	      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>NO</th>
				<th>ID Order</th>
				<th>Username</th>
		        <th>Tgl Order</th>
		        <th>Waktu</th>
		        <th>Total Bayar</th>
		        <th>Status</th>
				<th class="print-none">Action</th>
	          </tr>
	        </thead>
	        <tbody>

          <?php $i = 1; ?>
		  <?php foreach ( $table as $row ) : 
		  	$currentid = $row["id_order"];
		  	$table2 = query("
			    SELECT * FROM invoice_order 
			    WHERE id_order = '$currentid'
			    ");
		    //print_r($table2);
		  ?>
			  <tr>
				<td><?= $i; ?></td>
				<td><?= $row["id_order"]; ?></td>
				<td><?= $row["username"]; ?></td>
				<td><?= $row["tgl_order"]; ?></td>
				<td><?= $row["waktu"]; ?></td>
				<td><?= $row["total_payment"]; ?></td>
				<td><?= $table2[0]["paid"]; ?></td>

				<!-- yang belum diedit : -->
	            <td class="print-none">
	                <form action="" method="post" enctype="multipart/form-data" class="print-none">

	                <!-- kirim data yang sudah dichecklist ke script ajax, dan tampilkan di layar data yg telah terchecklist dengan checkbox yg jg telah terchecklist -->

	                	<input type="checkbox" class="mr-2 checkbox print-none" name="chosen" id="chosen" value="<?= $row["id_order"];?>" onclick="toggleCheckbox(this)" 
	                	<?= $row["status"] == 1 ? "checked" : "" ?>
	                	> 

	                    <input type="hidden" name="edit" value="" class="print-none">

	                    <button type="submit" name="delete" class="btn btn-secondary btn-sm rounded-0 print-none" onclick="return confirm('Yakin hapus data ini?');" >DELETE</button>
	                    
                    <?php 
                    if ( $table2[0]["paid"] != "pending" ) : ?>
                    	<a class="btn btn btn-success btn-sm rounded-0" name="details" href="order_details.php?id=<?=$row["id_order"];?>" >DETAILS</a>
                    	
                    <?php endif;?>
	                    <input type="hidden" name="id" value="<?=$row["id_order"];?>" >
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
			url: "orders.php",

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

