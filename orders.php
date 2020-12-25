<?php 

  require_once 'session.php';
  require_once 'function.php';

  if( !isset($_SESSION["cloethes"]) ) {
    header("Location: login.php");
    exit;
  }
  $username = $_SESSION['cloethes'];

  $table = query("
    SELECT * FROM order_data 
    WHERE order_data.username = '$username'");
  $ntable = count($table);
  $total = 0;
  foreach ($table as $key => $row) {
    $id_order[] = $row["id_order"];
    $tgl_order[] = $row["tgl_order"];
    $waktu[] = $row["waktu"];
    //$quantity[] = $row["quantity"];
  }

  $table2 = query("
    SELECT * FROM anggota WHERE username = '$username'");
  foreach ($table2 as $row2) {
    $alamat = $row2["alamat"];
  }
  

/*  $ntable = count($table); // banyak table atau banyak invoice
  foreach ($table as $key => $value) {
    $idorder = $value['id_order'];
    $user_data = $value['username'];
    $date = $value['tgl_order'];
    $time = $value['waktu'];
    $address = $value['alamat'];
  }*/
/*
  $total_qty = 0;
  $total_payment = 0;
  foreach ($table2 as $key => $value) {
    $id_order[] = $value['id_order'];
    $id_produk[] = $value['id_produk'];
    $user_data[] = $value['username'];
    $price[] = $value['total_payment'];
    $date[] = $value['tgl_order'];
    $time[] = $value['waktu'];
    $address[] = $value['alamat'];
    $qty[] = $value['jml_order'];
    $status[] = $value['status'];
  }

  for ($i=0; $i < $ntable ; $i++) { 
    $id = $id_produk[$i];
    $products[] = query("SELECT * FROM produk WHERE id_produk = '$id'")[0];
  }
  $i = 0;
  foreach ($products as $row) {
    $img[] = $products[$i]['foto'];
    $i++;
  }
  */
  // cek apakah tombol submit sudah ditekan atau belum

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/invoice.css">

    
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


  
  <div class="container mb-5">
    <div class="row row-invoice">

      <?php 
        include_once 'includes/myaccount-navbar.php';
      ?>

      <div class="col-md-8 cart-data">


      <!-- Form my account -->
        <h5 class="invoice-caption">My Orders</h5>

        <div class="order-details">
          <div class="row input-form mb-5">

            <div class="col-md-6 mt-3">
              
              <p class="little-left bold" style="margin-bottom: auto;">Email / Username</p>
              <p class="little-left mt-0"><?=$username;?> </p>
            </div>

            <div class="col-md-6 right-inline">
              <h6 class="invoice-detail">Delivery Type</h6>
              <p>Standard Delivery</p>
            <?php 
            if ( isset($_SESSION["mysession"]) ) :?>
              <h6 class="invoice-detail mt-4">Address</h6>
              <p><?=$alamat; ?></p>
              
            <?php endif; ?>
            </div>
          </div>

          <h6 class="invoice-caption">Orders Summary</h6>
          <div class="row invoice-row">
            
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
                  if ( empty($table) ) {
                    echo "You don't have any order history.";
                  }
                  for ($i=0; $i < $ntable ; $i++) :?>
                    <tr>
                      <td class="_text-center"><?= $nomor; ?></td>
                      <td class="_text-center"><?= $id_order[$i]; ?></td>
                      <td class="_text-center"><?= $tgl_order[$i]; ?></td>
                      <td width="10px" class="_text-center"><?= $waktu[$i]; ?></td>
                      <td width="10px" class="_text-center">
                        <a href="invoice.php?id=<?=$id_order[$i];?>" class="link">Details &raquo;</a>
                      </td>

                    </tr>
                <?php 
                $nomor++; endfor; ?>

                </tbody>
              </table>
            </div>
          </div>

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