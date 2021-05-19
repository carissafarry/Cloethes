<?php 

	require 'function.php';
	$table = query("SELECT * FROM order_data");


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/sb-admin-2.min.css">
  <link rel="stylesheet" href="css/orders.css">
 </head>

<body id="page-top">
  <div id="wrapper">


	<!-- Container -->
	<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add Order Data</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Container Fluid -->
	<div class="container-fluid">

	  <div class="card-body">

	  	<!-- Tabel Data -->
	    <div class="table-responsive">

	      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        <thead>
	          <tr>
	            <th>NO</th>
				<th>ID Order</th>
				<th>ID Anggota</th>
				<th>ID Produk</th>
		        <th>Tgl Order</th>
		        <th>Waktu</th>
		        <th>Qty</th>
		        <th>Total Payment</th>
	          </tr>
	        </thead>
	        <tbody>

	          <?php $i = 1; ?>
			  <?php foreach ( $table as $row ) : ?>
			  <tr>
				<td><?= $i; ?></td>
				<td><?= $row["id_order"]; ?></td>
				<td><?= $row["id_anggota"]; ?></td>
				<td><?= $row["id_produk"]; ?></td>
				<td><?= $row["tgl_order"]; ?></td>
				<td><?= $row["waktu"]; ?></td>
				<td><?= $row["jml_order"]; ?></td>
				<td><?= $row["total_payment"]; ?></td>

	          </tr>
	        <?php $i++; ?>
			<?php endforeach; ?>
	        </tbody>
	      </table>

	    </div>
	  </div>
	</div>

  </div>
</body>

</html>
