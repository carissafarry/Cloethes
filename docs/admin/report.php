<?php 
  require_once 'session.php';
  require_once 'function.php';
  require_once 'database/dbconfig.php';

  include_once('includes/header.php'); 
  include_once('includes/navbar.php'); 
  

  $table = array();
  $tgl_mulai = "-";
  $tgl_selesai = "-";

  // Notifikasi tambah data berhasil
  if( isset($_POST['kirim']) ) {

    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];

    $query = "SELECT * FROM order_data od
      WHERE tgl_order BETWEEN '$tgl_mulai' AND '$tgl_selesai'
      ";

    $result = mysqli_query($conn, $query);
    while( $row = mysqli_fetch_assoc($result) ) {
      $table[] = $row;

    }

    $table2 = query("
      SELECT * FROM order_data
      ");

    foreach ($table2 as $row2) {
      $id_order = $row2["id_order"];
      $user_data[] = $row2["username"];

      $table3 = query("
        SELECT * FROM invoice_order WHERE id_order = '$id_order'
      ")[0];
      $status[] = $table3["paid"];
    }
    

  }
?>


<form method="post">
  <div class="row">
    <div class="col-md-5">
      <div class="form-group" style="padding-left: 25px;">
        <label>Tanggal Mulai</label>
        <input type="date" name="tglm" class="form-control">
      </div>
    </div>

    <div class="col-md-5">
      <div class="form-group">
        <label>Tanggal Selesai</label>
        <input type="date" name="tgls" class="form-control">
      </div>
    </div>

    <div class="col-md-2">
      <label>&nbsp;</label><br>
      <button class="btn btn-primary" name="kirim">
        Process
      </button>
    </div>
  </div>
  
</form>

<!-- Container Fluid -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> REPORT ORDER DATA
      </h6>
    </div>

    <div class="card-body">

      <!-- Tabel Data -->
      <div class="table-responsive">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>NO</th>
        <th>Pelanggan</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Status</th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 0; ?>
        <?php foreach ( $table as $row ) : ?>
        <tr>
          <td><?= $i+1; ?></td>
          <td><?= $user_data[$i]; ?></td>
          <td><?= $row["tgl_order"]; ?></td>
          <td><?= $row["waktu"]; ?></td>
          <td><?= $status[$i]; ?></td>

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
