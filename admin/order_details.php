<?php 
	require 'session.php';
	require 'function.php';

	include('includes/header.php'); 
	include('includes/navbar.php'); 

	
	$getid = $_GET['id'];
	$table = query("
	    SELECT * FROM invoice_order 
	    LEFT OUTER JOIN payment
	    ON invoice_order.id_order = payment.id_order
	    WHERE invoice_order.id_order = '$getid'
	    ");

	$table2 = query("
		SELECT * FROM order_data
		WHERE id_order = '$getid'
		");

	foreach ($table as $key => $row) {
		$id_invoice[] = $row["id_invoice"];
		$id_produk[] = $row["id_produk"];
		$quantity[] = $row["quantity"];
		$harga[] = $row["total_bayar"];
		
		// variabel yang hanya diambil satu nilainya saja
		$id_payment = $row["id_payment"];
		$id_order = $row["id_order"];
		$status = $row["paid"];
		$username = $row["username"];
		$atas_nama = $row["atas_nama"];
		$total_payment = $row["total_payment"];
		$bank = $row["bank"];
		$tgl_payment = $row["tgl_payment"];
		$time_payment = $row["time_payment"];
		$payment_proof = $row["payment_proof"];
		$resi = $row["shipping_num"];
	}

	foreach ($table2 as $row) {
		$tgl_order = $row["tgl_order"];
		$waktu_order = $row["waktu"];
		$alamat = $row["alamat"];
	}

	if (isset($_POST["process"])) {
		if ( update_resi($_POST) > 0 ) {
			echo "
				<script>
					alert('Status berhasil diupdate!');
					document.location.href = 'orders.php';
				</script>
			";
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

?>
<style type="text/css">
	
	.@media print {
		.print-none {
			display: none;
		}
	}
	button.print-btn {
		margin-right: 15px;
	}
	.right-inline {
	  text-align: end;
	}
	._text-right {
	  text-align: right;
	}
	._text-center {
	  text-align: center;
	}
	._text-left {
	  text-align: left;
	}
	.bold {
	  font-weight: bold;
	}
	.order-details {
	  padding-left: 3%;
	}
	.pr-5 {
		padding-right: 5%;
	}
	.mb-auto {
		margin-bottom: auto;
	}
	.pr-50 {
		padding-right: 50px;
	}
</style>

<!-- Container Fluid -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
	  <div class="card-header py-3">
	    <h6 class="m-0 font-weight-bold text-primary">PAYMENT DATA
<!--
	    	<form action="" method="post" class="mt-0">
	    	  <button type="submit" name="deletechosen" id="deletechosen" class="btn btn-danger ml-3 deletechosen print-none" data-toggle="modal" style="float: right;">
	              Delete Chosen Data
	          </button>
	        </form>

	        <button type="button" class="btn btn-primary print-none" data-toggle="modal" data-target="#addadminprofile" style="float: right;"> Add Data
	        </button>
-->

	        <a href="print.php">
		        <button type="button" class="btn btn-primary print-none print-btn"style="float: right;" target="blank"> Report
		        </button>
	        </a>
	    </h6>
	  </div>

	  <div class="card-body mb-5">

	<!-- Payment Data -->
        <h5 class="invoice-caption order-details mt-3">Payment ID #<?= $id_payment; ?></h5>

        <div class="order-details">
          <div class="row input-form">
            <div class="col-md-6 mt-3">
              <p class="bold mb-auto">Email / Username</p>
              <p class="mt-0"><?=$username;?> </p>
              
            </div>

            <div class="col-md-6 right-inline pr-5 mt-3">
              <h6 class="invoice-detail bold mb-auto">Delivery Type</h6>
              <p>Standard Delivery</p>

              
            </div>

          </div>


          <div class="row mb-4">

          	<div class="col-md-4">
          		<h6 class="bold">Alamat Pengiriman</h6>
          		<p><?=$alamat;?></p>

          	</div>

          	<div class="col-md-4">
          		<div class="row">
          		<div class="col">
          			<h6 class="invoice-detail bold mb-auto">Order ID</h6>
              		<p class="mt-0"><?=$id_order?></p>
          		</div>
          		<div class="col">
	          		<h6 class="invoice-detail bold mb-auto">Order Date</h6>
	              	<p><?=$tgl_order; ?></p>
	              	<h6 class="invoice-detail bold mb-auto">Order Time</h6>
	              	<p><?=$waktu_order; ?></p>
              	</div>
              	</div>
          	</div>
          	<div class="col-md-4 right-inline pr-50">
          		<h6 class="bold mb-auto">Biaya Pemesanan</h6>
          		<p style="color: green; font-weight: bolder;">Free</p>
          	</div>
          </div>

          <h6 class="invoice-caption bold mt-2">PAYMENT DETAILS</h6>

		  <div class="row">
		    <div class="col-md-4">
		      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		        <div class="carousel-inner">

		          <div class="carousel-item active">
		            <img src="../assets/img/payment/<?=$payment_proof;?>" class="d-block w-100" width="80">
		          </div>
		        </div>
		      </div>
		    </div>



		    <div class="col-md-8 pr-50 order-details">
		      <div class="table-responsive">

		        <table class="table border-0" id="dataTable" cellspacing="0">

		          <thead>
		            <tr>
		              <th>No</th>
					  <th>Atas Nama</th>
					  <th>Total Bayar</th>
					  <th>Bank</th>
			          <th>Tgl Bayar</th>
			          <th>Waktu Bayar</th>
		            </tr>
		          </thead>

		          <tbody>
		          <?php $i = 1; ?>
				    <tr>
					  <td><?= $i; ?></td>
					  <td><?= $atas_nama; ?></td>
					  <td>IDR <?= number_format($total_payment); ?></td>
					  <td><?= $bank; ?></td>
					  <td><?= $tgl_payment; ?></td>
					  <td><?= $time_payment; ?></td>
		            </tr>
		          <?php $i++; ?>

		          </tbody>
		    	</table>

		      <form method="post">
		      	<input type="hidden" name="id_order" value="<?=$id_order;?>">
		      	<div class="form-group">
		      		<label>No Resi</label>
		      		<input type="text" name="resi" class="form-control" placeholder="Input resi pengiriman" value="<?=$resi;?>">
		      	</div>

		      	<div class="form-group">
		      		<label>Status</label>
		      		<select class="form-control" name="status" style="width: 25%;">
		      			<option value="paid">Lunas</option>
		      			<option value="goods sent">Barang Dikirim</option>
		      			<option value="canceled">Batalkan</option>
		      		</select>
		      	</div>

		      	<button type="submit" class="btn btn-success print-none print-btn mt-3 ml-3" style="float: right; margin-right: 0;" name="process">Process</button>

		      	<a href="orders.php">
		      		<button type="button" class="btn btn-primary mt-3" style="float: right; margin-right: 0;" name="back">Back</button>
		      	</a>

	        	</div>	
	          </form>

			  </div>
			</div>
		  </div>
      	</div>

	  </div>
	</div>
</div>
<!-- ./Container Fluid -->




<?php include('includes/scripts.php'); ?>

<?php include('includes/footer.php'); ?>

