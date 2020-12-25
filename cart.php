<?php

  require_once 'session.php';
  require_once 'function.php';
  require_once 'admin/database/dbconfig.php';

  $table = query("SELECT * FROM produk");
  date_default_timezone_set('Asia/Jakarta');
  date_default_timezone_get();

  // hapus produk dalam keranjang, bila ada data idproduk yang akan dihapus yang ditangkap
  if( !empty($_REQUEST['id_remove']) ) {

    $id_remove = $_REQUEST['id_remove'];

    // jika keranjang tidak kosong:
    if( !empty( $_SESSION['cart'] ) ) {

      // $key menunjuk pada indeks angka dari data keranjang (0,1,2)
      foreach ($_SESSION['cart'] as $key => $value) {

        if( $value['id_produk'] == $id_remove ) {

          // hapus produk pd cart dg id yg sesuai
          unset($_SESSION['cart'][$key]);
          echo "
            <script>
              window.location = 'cart.php'
            </script>
          ";
        } 
      }
    }
  }

  // tambahkan data keranjang ke tabel database bila user melakukan checkout
  if( isset($_POST['checkout']) ) {
    if( isset($_SESSION['cloethes']) ) {

      $date = date('Y-m-d');
      $time = date('H:i:s');

      if ( $last_id = insertcart_db($_SESSION['cloethes'], $_SESSION['cart'], $date, $time, $_POST['alltotal']) ) {
        //$_SESSION["checkout"];
        header("Location: thankyou.php");
        exit;
      }

    } else {
      header("Location: login.php");
      exit;
    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/cart.css">

    
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


  
  <div class="container cart-section">
    <div class="row row-cart">
      <div class="col-md-4 cart-side">
        <ul class="ul-cart-side">
          <li>
            <a href="" class="link">Login</a>
          </li>
          <li>
            <a href="" class="link">Shipping Information</a>
          </li>
          <li>
            <a href="" class="link">Returns Policy</a>
          </li>
          <li>
            <a href="" class="link">Contact Customer Care</a>
          </li>
        </ul>
      </div>

      <div class="col-md-8 cart-data">

      <!-- Form Keranjang -->
        <form action="" method="post" class="form-cart">
          <table class="shop-table">
            <thead class="cart-table-header">
              <tr class="cart-table-row">

                <th class="product-remove">&nbsp</th>
                <th class="product-name" colspan="2">Product</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-subtotal _text-right">Total</th>

              </tr>
            </thead>

            <tbody>
            <!--
              <tr class="data-cart-row">
                <td class="product-remove">
                  <a href="" class="remove link">
                    x
                  </a>
                </td>

                <td class="product-thumbnail">
                  <a href="assets/img/product/<?= $table["foto"];?>">
                    <img width="85" src="assets/img/product/<?= $table["foto"];?>">
                  </a>
                </td>

                <td class="product-name">
                  <a href="details.php?id= <?=$table["id_produk"]?>" class="link">
                    <?= $table["nama_produk"];?>
                  </a>
                </td>

                <td class="product-price">
                  <div class="_flex-col _h-center">
                    <?= $table["harga"];?>
                  </div>
                </td>

                <td class="product-quantity quantity">

                  <button type="button" class="btn bg-0 border-0 qty-btn">
                    <i class="fas fa-minus"></i>
                  </button>

                  <input type="text" value="1" class="form-control w-17 d-inline quantity-input border-0" name="qty">

                  <button type="button" class="btn bg-0 border-0 qty-btn">
                    <i class="fas fa-plus"></i>
                  </button>

                </td>

                <td class="product-subtotal _text-right">
                  <?= $table["harga"];?>
                </td>
              </tr>

            -->
    <?php 
      $total = 0;

      if ( isset($_SESSION['cart']) ) {
        if( !empty($_SESSION['cart']) ) {

          foreach ( $_SESSION['cart'] as $row2 ){
            $id_produk_array[] = $row2["id_produk"];
            //$nama[] = $row2["nama"];
            $qty[] = $row2["quantity"];
            $size[] = $row2["ukuran"];
          }

          $request = "SELECT * FROM produk";
          $result = mysqli_query($conn, $request);

          while( $p_row = mysqli_fetch_assoc($result) ) {
            $i = 0;
            foreach ($id_produk_array as $id) {
              $qty2 = $qty[$i];
              if( $p_row['id_produk'] == $id ) {


                // memanggil fungsi dalam function.php untuk menampilkan daftar produk di cart
                cart_product(
                  $p_row['id_produk'],
                  $p_row['nama_produk'],
                  $p_row['foto'],
                  $qty2,
                  $p_row['harga'],
                  $size
                );
                
                $ntotal = $qty2 * (int) $p_row['harga'];
                $total = $total +  $ntotal;
                $ntotal = (int) $p_row['harga'];
              }
              $i++;
            }  
          }

        } else {
          echo '<h5 style="text-align: center; margin-bottom: 100px; margin-left: -60px;">Your cart is currently empty. </h5>';
        }
      } else {
        echo '<h5 style="text-align: center; margin-bottom: 100px; margin-left: -60px;">Your cart is currently empty. </h5>';
      }
    ?>
              <tr>
                <td colspan="6" class="actions _text-right">
                  <div class="coupon">

                    <input type="text" name="coupon_code" id="coupon_code" placeholder="Coupon Code">

                    <input type="submit" name="apply_coupon" value="Apply Coupon">

                  </div>
                </td>
              </tr>
            </tbody>

          </table>
        </form>
        
      <!-- End Form Keranjang -->
        <form action="" method="post">

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
              <form>
                <input type="hidden" name="alltotal" value="<?= $total; ?>">
                <button type="submit" class="checkout-btn" name="checkout">
                  Proceed
                </button>
              </form>

            </div>
          </div>
        </form>

      </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>
<?php include('includes/scripts.php'); ?>

  </body>

<script>

</script>

</html>