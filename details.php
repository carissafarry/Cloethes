<?php

require_once 'session.php';
require_once 'function.php';

$id = $_GET["id"];
$table = query("SELECT * FROM produk WHERE id_produk = $id")[0];


if (isset($_POST["addtocart"])) {

  // jika sudah terbentuk
  if (isset($_SESSION['cart'])) {

    // isi session dg semua id produk dari produk2 di keranjang. tampung semua data id_produk di session tsb (data lama) pada variabel baru.

    $item_array_id = array_column($_SESSION['cart'], "id_produk");
    $count = 0;
    foreach ($_SESSION['cart'] as $row2) {
      $count += $row2['quantity'];
    }

    // lakukan perbandingan dg data cart lama yg telah disimpan di variabel. jika id produk baru yg diinput user sudah ada di dalam keranjang:

    if (in_array($_POST['id_pcart'], $item_array_id)) {

      $i = 0;
      foreach ($_SESSION['cart'] as $row) {
        if ($row["id_produk"] == $_POST['id_pcart']) {
          $id = $i;
          $item_array = update_product($_SESSION['cart'][$id]);
          $_SESSION['cart'][$id] = $item_array;
          $count++;
        }
        $i++;
      }

      // jika produk yg dipilih belum ada di keranjang, maka tambahkan ke keranjang pada variabel baru, kemudian input juga ke session cart
    } else {
      //$count++;
      $item_array = addtocart($_POST);

      // tambahkan produk baru pada indeks terakhir
      $_SESSION['cart'][$count] = $item_array;
    }


    // jika cart belum terbentuk, maka isi data cart baru di indeks awal
  } else {
    $item_array = addtocart($_POST);
    $_SESSION['cart'][0] = $item_array;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/details.css">


  <title>c l o e t h e s</title>
  <link href="assets/img/page/logo.png" rel="shortcut icon">

</head>

<marquee onmouseover="this.stop()" onmouseout="this.start()"> <a href="products.php" class="link">
    <span>
      free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
    </span>
    <span>
      free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
    </span>
  </a> </marquee>


<?php include 'includes/navbar.php'; ?>

<body>
  <div class="container products">
    <div class="row">

      <div class="col-md-5">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <img src="assets/img/product/<?= $table["foto"]; ?>" class="d-block w-100" alt="First Slide" width="90">
            </div>


          </div>

          <!-- Next and Prev Carousel Controller -->
          <!--
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
-->
        </div>
      </div>

      <div class="col-md-7">
        <div class="sticky">
          <p class="productpic text-center">NEW</p>
          <h4><?= $table["nama_produk"]; ?></h4>
          <p class="mb-4">Product ID: <?= $table["id_produk"] ?></p>
          <p class="mb-1 description">Description:<br> <?= $table["deskripsi_produk"] ?></p>
          <p class="mt-3">Model is:
            <span>173</span>
            cm
          </p>
          <p>IDR <?= $table["harga"] ?></p>


          <form action="" method="post" enctype="multipart/form-data">
            <div class="textbox">

              <input type="hidden" name="id_pcart" value="<?= $table["id_produk"]; ?>">

              <input type="hidden" name="nama" value="<?= $table["nama_produk"]; ?>">

              <input type="hidden" name="qty" value="1">

              <select class="mr-3 border-0 outline-0" name="size">
                <option value="<?= $table["ukuran"]; ?>"><?= $table["ukuran"]; ?></option>
              </select>

              <button type="submit" name="addtocart" class="add-btn outline-0">
                <img src="assets/img/page/arrow.svg" class="btn arrow" />
              </button>

              <!--
              <input type="hidden" id="<?= $table["id_produk"]; ?>" value="<?= $table["id_produk"]; ?>" name="id">

              <input type="hidden" id="qty<?= $table["id_produk"]; ?>" value="1" name="qty">

              <select class="mr-3 border-0" id="size<?= $table["id_produk"]; ?>" name="size" >
                <option value="<?= $table["ukuran"]; ?>" selected="selected"><?= $table["ukuran"]; ?></option>
              </select>
              
              <img src="assets/img/page/arrow.svg" type="submit" class="arrow addtocart" id="<?= $table["id_produk"]; ?>" name="addtocart" />
-->

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>
  <?php include('includes/scripts.php'); ?>


</body>


</html>