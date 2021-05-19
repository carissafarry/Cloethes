<?php 

  require_once 'session.php';
  require_once 'function.php';

  
  $username = $_SESSION["cloethes"];
  
  $getid = $_GET['id'];
  date_default_timezone_set('Asia/Jakarta');
  date_default_timezone_get();

  $table = query("
    SELECT * FROM invoice_order 
    LEFT OUTER JOIN order_data
    ON invoice_order.id_order = order_data.id_order
    WHERE invoice_order.id_order = '$getid'
    ");

  foreach ($table as $key => $row) {
    // hanya butuh satu data
    $id_order = $row["id_order"];
    $user_data = $row["username"];
    $tgl_order = $row["tgl_order"];
    $total_payment = $row["total_payment"];
    $paid_status = $row["paid"];
    $alamat = $row["alamat"];
  }

  $table2 = query("
    SELECT * FROM anggota WHERE username = '$user_data'
    ")[0];
  $id_anggota = $table2["id_anggota"];
  $nama = $table2["nama"];
  $email = $table2["email"];
  $tgl_lahir = $table2["tgl_lahir"];

  if( isset($_SESSION["cloethes"]) ) {
    if ( !isset($_GET["id"]) || ( $user_data != $username ) ) {
      header("Location: orders.php");
      exit;
    }
  } else {
    header("Location: login.php");
    exit;
  }

  // tambahkan data bayar dan buktinya ke tabel pembayaran bila telah mengirim bukti pembayaran
  $date = date('Y-m-d');
  $time = date('H:i:s');

  if( isset($_POST["send"]) ) {   
    if( addpayment($_POST) == 00000 ) {
      header("Location: success_confirm.php");
      exit;
    } else {
      echo "
      <script>
        alert('Failed to confirm or you have confirmed the payment!');
        document.location.href = 'orders.php';
      </script>";
    }
  }

?>





<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/confirm.css">

    
  <title>c l o e t h e s</title>
  <link href="assets/img/page/logo.png" rel="shortcut icon">

</head>
  
<marquee onmouseover="this.stop()" onmouseout="this.start()" > <a href="products.php" class="link">
  <span>
    free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
  </span>
  <span>
    free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
  </span>
</a> </marquee>


<?php include 'includes/navbar.php'; ?>
<body>


  
  <div class="container mb-3">
    <div class="row row-invoice">

      <?php 
        include_once 'includes/myaccount-navbar.php';
      ?>

      <div class="col-md-8 cart-data"> <!-- kolom ke dua -->


      <!-- Form my account -->
        <h5 class="invoice-caption">Invoice #<?=$getid; ?></h5>

        <div class="order-details">
          <div class="row input-form mb-4">

            <div class="col-md-6 mt-3">
              
              <p class="little-left bold" style="margin-bottom: auto;">Email / Username</p>
              <p class="little-left mt-0"><?=$username;?> </p>
            </div>

            <div class="col-md-6 right-inline">
              <h6 class="invoice-detail">Delivery Type</h6>
              <p>Standard Delivery</p>

              <h6 class="invoice-detail mt-4 mb-0">Total Billing Payment</h6>
              <p>IDR <?= number_format($total_payment); ?></p>

            </div>
          </div>



          <h6 class="invoice-caption">Confirmation Payment</h6>

        <form action="" method="POST" enctype="multipart/form-data">
      
          <input type="hidden" name="id_order" value="<?=$id_order;?>">
          <input type="hidden" name="username" value="<?=$username;?>">
          <input type="hidden" name="total_payment" value="<?=$total_payment;?>">
          <input type="hidden" name="date" value="<?=$date;?>">
          <input type="hidden" name="time" value="<?=$time;?>">
          <input type="hidden" name="status" value="in confirmation">

          <div class="row input-form">
            <div class="form-group form-row-first">
              <label for="name">Atas Nama</label>
              <input class="form-control form-input" type="text" name="nama" id="nama" placeholder="Masukkan nama" value="<?= $nama;?>" required>
            </div>

            <div class="form-group form-row-last">
              <label for="ttl">Tanggal Lahir</label>
              <input class="form-control form-input" type="date" name="ttl" id="ttl" placeholder="Input date" value="<?= $tgl_lahir;?>" required>
            </div>
          </div>

          <div class="row input-form mt-3">
            <div class="form-group form-row-first">
              <label for="alamat">Alamat</label>
              <textarea type="text" class="form-control form-input font-15 mb-3" id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat"  required ><?=$alamat;?></textarea>
            </div>  

            <div class="form-row-last" style="display: flex;">
              <div class="form-group">
                <label for="bank">Bank</label>
                <select name="bank" id="bank" class="form-control form-input font-15 border-0" style="outline: none; background: none;">
                  <option value="Mandiri">Mandiri</option>
                  <option value="BRI">BRI</option>
                  <option value="BNI">BNI</option>
                  <option value="CIMB">CIMB Niaga</option>
                </select>
              </div>

              <div class="form-group norek-form">
                <label for="bank">No Rekening</label>
                <input class="form-control form-input col-md-10" type="text" name="norek" id="norek" placeholder="Masukkan rekening" required>
              </div>

            </div>
          </div>

          <div class="row input-form">
            <div class="form-group form-row-first font-14">
              <label for="foto">Upload Bukti Foto</label>
              <input type="file" class="form-control-file bg-0" name="foto" id="foto" required>
            </div>
          </div>

          <div class="row invoice-btn mt-4">
            <div class="invoice-btn" style="width: 75%; line-height: 8;">
              <a href="invoice.php?id=<?=$getid;?>" class="link">&larr; back</a>
            </div>

            <p>
              <button type="submit" class="btn-edit" name="send" value="Send Confirmation"> Send Confirmation
              </button>
            </p>
          
          </div>


        </form>

<!--
            <div class="order-summary">
              <table class="shop-table">
                <thead class="cart-table-header _text-center">
                  <tr class="cart-table-row">

                    <th class="product-remove" style="width: 10%">No</th>
                    <th class="product-remove" style="width: 20%;">Invoice ID</th>
                    <th class="product-name" style="width: 20%;">Order Date</th>
                    <th class="product-quantity" style="width: 15%;" >Time</th>
                    <th class="product-quantity" style="width: 15%;" >Information</th>


                  </tr>
                </thead>

                <tbody> 
                <?php 
                  $nomor = 1; 
                  for ($i=0; $i < $ntable ; $i++) :?>
                    <tr>
                      <td class="_text-center"><?= $nomor; ?></td>
                      <td class="_text-center"><?= $id_order[$i]; ?></td>
                      <td class="_text-center"><?= $tgl_order[$i]; ?></td>
                      <td width="10px" class="_text-center"><?= $waktu[$i]; ?></td>
                      <td width="10px" class="_text-center">
                        <a href="invoice.php?id=<?=$id_order[$i];?>" class="link">Details&raquo;</a>
                      </td>

                    </tr>
                <?php $nomor++; endfor; ?>

                </tbody>
              </table>
            </div>

          </div>
-->
        </div>
      </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>
<?php include('includes/scripts.php'); ?>

  </body>

<script>

</script>

</html>