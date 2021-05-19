<?php 

  require_once 'session.php';
  require_once 'function.php';

  $username = $_SESSION['cloethes'];
  $getid = $_GET['id'];

  $table = query("SELECT * FROM order_data WHERE id_order = $getid");

  $ntable = count($table); // banyak table atau banyak invoice
  foreach ($table as $key => $value) {
    $idorder = $value['id_order'];
    $user_data = $value['username'];
    $date = $value['tgl_order'];
    $time = $value['waktu'];
    $address = $value['alamat'];
  }
/*
  $table2 = query("
      SELECT * FROM invoice_order WHERE id_order = '$getid'
    ");
  foreach ($table2 as $row) {
    $status = $row["paid"];
    $resi = $row["shipping_num"];
  }
*/

  if( isset($_SESSION["cloethes"]) ) {
    if ( !isset($_GET["id"]) || ( $user_data != $username ) ) {
      header("Location: orders.php");
      exit;
    }
  } else {
    header("Location: login.php");
    exit;
  }

  // cek apakah tombol submit sudah ditekan atau belum
  if( isset($_POST["save"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if ( user_edit($_POST) > 0 ) {
      // menggunakan javascript untuk menampilkan notifikasi
      echo "
        <script>
          alert('Data user berhasil diubah!');
          document.location.href = 'myaccount.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data user gagal diubah!');
          document.location.href = 'myaccount.php';
        </script>
      ";
    }
  }
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


  
  <div class="container">
    <div class="row row-invoice">

      <?php 
        include_once 'includes/myaccount-navbar.php';
      ?>

      <div class="col-md-8 cart-data">


        <?php

          $data = query("
            SELECT * FROM invoice_order JOIN produk 
            ON invoice_order.id_produk = produk.id_produk
            WHERE invoice_order.id_order = '$getid'
            ");
          $ndata = count($data);
          $total = 0;
          foreach ($data as $row) {
            $id_order[] = $row["id_order"];
            $id_invoice[] = $row["id_invoice"];
            $id_produk[] = $row["id_produk"];
            $qty[] = $row["quantity"];
            $price[] = $row["harga"];
            $foto[] = $row["foto"];
            $status[] = $row["paid"];
            $nqty = $row['quantity'];
            $nprice = $row['harga'];
            $subtotal = $nqty * $nprice;
            $total += $subtotal;
            $resi = $row["shipping_num"];
          }
        ?>

      <!-- Form my account -->
        <h5 class="invoice-caption">Invoice #<?= $id_order[0]; ?></h5>

        <div class="order-details">
          <div class="row input-form">

            <div class="col-md-6 mt-3">
              
              <p class="little-left bold" style="margin-bottom: auto;">Email / Username</p>
              <p class="little-left mt-0"><?=$user_data;?> </p>
            </div>

            <div class="col-md-6 right-inline">
              <h6 class="invoice-detail">Delivery Type</h6>
              <p>Standard Delivery</p>
              <h6 class="invoice-detail mt-4">Order Date</h6>
              <p><?=$date; ?></p>
            </div>
          </div>

          <h6 class="invoice-caption">Invoice Summary</h6>
          <div class="row invoice-row">
            
            <div class="order-summary">
              <table class="shop-table">
                <thead class="cart-table-header _text-center">
                  <tr class="cart-table-row">

                    <th class="product-remove" style="width: 10%">No</th>
                    <th class="product-remove" style="width: 20%;">Invoice ID</th>
                    <th class="product-name _text-left" style="width: 20%;" colspan="2" >ID  |  Product</th>
                    <th class="product-quantity" style="width: 15%;" >Quantity</th>
                    <th class="product-quantity">Status</th>
                    <th class="product-subtotal">Total</th>

                  </tr>
                </thead>

                <tbody> 
                <?php 
                  $nomor = 1; 
                  for ($i=0; $i < $ndata ; $i++) :?>
                    <tr>
                      <td class="_text-center"><?= $nomor; ?></td>
                      <td class="_text-center"><?= $id_invoice[$i]; ?></td>
                      <td class="_text-center"><?= $id_produk[$i]; ?></td>
                      <td class="_text-center">
                        <img src="assets/img/product/<?= $foto[$i]; ?>" class="img-invoice">
                      </td>
                      <td width="10px" class="_text-center"><?= $qty[$i]; ?></td>
                      <td class="_text-center"><?= $status[0]; ?></td>
                      <td class="_text-center last-column">IDR <?= number_format($price[$i]); ?></td>

                    </tr>
                <?php $nomor++; endfor; ?>

                </tbody>
              </table>
            </div>
          </div>


          <!-- Table Total Pembayaran -->
          <div class="pay-table">
            <div class="payment-col">
            <div class="payment-table">
              <table class=" total-payment">
                <tbody>
                  <tr class="order-total">
                    <th>Subtotal</th>
                    <td class="payment-td">IDR 
                      <?= number_format($total); ?>
                    </td>
                  </tr>

                  <tr class="order-total">
                    <th>Total</th>
                    <td class="payment-td">IDR
                      <?= number_format($total); ?>
                    </td>
                  </tr>

                <?php if (!empty($resi)) :?>
                  <tr class="order-total">
                    <th>Shipping Number</th>
                    <td class="mr-x">
                      <?=$resi; ?>
                    </td>
                  </tr>
                <?php endif; ?>

                </tbody>
              </table>
          </div>
<!--
            <div class="subtotal">
              <div class="cart-total">
                <table class="cart-total-table _text-left" >
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>IDR 
                        <?= $total; ?>
                      </td>
                    </tr>

                    <tr class="order-total">
                      <th>Total</th>
                      <td>IDR
                        <?= $total; ?>
                      </td>
                    </tr>
                  </tbody>
                </table>

                </div>
              </div>
  -->
            </div>
              
          </div>




          <div class="row invoice-btn">
            <div class="invoice-btn" style="width: 75%; line-height: 8;">
              <a href="orders.php" class="link">&larr; back</a>
            </div>

            <?php 
            if ($status[0] == "pending") :?>
              <div class="invoice-btn">
                <a href="confirm.php?id=<?=$getid;?>">
                  <button class="pay-btn">
                    confirm now
                  </button>
                </a>
              </div>
            <?php endif;?>


            
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