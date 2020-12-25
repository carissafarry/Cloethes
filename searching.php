<?php 

  if ( !isset($_GET["keyword"]) ) {
    header("Location: products.php");
    exit();
  }

  require_once 'function.php';

  $keyword = $_GET["keyword"];
  $tables = query("
    SELECT * FROM produk 
    LEFT OUTER JOIN kategori
    ON produk.id_kategori = kategori.id_cat
    WHERE nama_produk LIKE '%$keyword%'
    OR deskripsi_produk LIKE '%$keyword%'
    OR warna LIKE '%$keyword%'
    OR nama_kategori LIKE '%$keyword%'
  ");


  $n = count($tables);
  $ndpr = 3;
  $nrow = ceil($n / $ndpr);

  $i = 1;
  foreach ( $tables as $row ){
    $id_produk[] = $row["id_produk"];
    $nama_produk[] = $row["nama_produk"];
    $foto[] = $row["foto"];
    $warna[] = $row["warna"];
    $ukuran[] = $row["ukuran"];
    $harga[] = $row["harga"];
    $deskripsi[] = $row["deskripsi_produk"];

    $i++;
  }

  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/products.css">

    
    <title>c l o e t h e s</title>
    <link href="assets/img/page/logo.png" rel="shortcut icon">
 

  </head>

<marquee class="marquee" onmouseover="this.stop()" onmouseout="this.start()" > <a href="products.php" class="link">
  <span>
    free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
  </span>
  <span>
    free shipping: indonesia + singapore on all orders. please expect delay on singapore delivery this week.
  </span>
</a> </marquee>

  <body>
<?php include 'includes/navbar.php'; ?>
    

  <!-- Catalog -->
    <div class="container pt-4">
<!--
      <h6 class="text-center pb-2" id="catalog">result of "<?=$keyword;?>"</h6>
-->
      <div class="row mb-4 pt-4">
        

    <?php include 'includes/products-navbar.php'; ?>

    <?php
    $a = 0;
    $i = 0;

    if ( empty($tables) ) {
      echo "
        <h4 class='pt-5 text-center'>sorry there are currently no products available for '<strong>$keyword</strong>'</h4>
      ";
    }




    while ($a < $nrow && $i < $n):
      for ($j=$i; $j <= 2 && $i<$n; $j++) : ?>
        <div class='col-sm-12 col-md-6 col-lg-3 small mb-2'>
          <div class='card'>
            <a href='details.php?id= <?=$id_produk[$i]?>'>
                <img src='./assets/img/product/<?=$foto[$i]?>' class='card-img-top'>
            </a>
            <div class='card-body'>
              <h7 class='card-title m-1'><a class='link' href='details.php?id= <?=$id_produk[$i]?>'> <?=$nama_produk[$i]?> </a></h7>
              
              <p class='card-text m-1'> <?=$warna[$i]?> </p>
              <a class='btn btn-light rounded-0 price'> <?=$harga[$i]?> </a>
              <a href='details.php?id= <?=$id_produk[$i]?>' class='btn btn-outline-dark btn-sm rounded-0'>Buy</a>
            </div>
          </div>
        </div>

      <?php $i++; endfor; $a++; ?>
    <?php endwhile;?>
      </div>


    <?php
    $a = 0;
    for ($k=1; $k < $nrow && $i < $n ; $k++) : ?> 
      <div class="row mb-4">
        <div class="col-3 mb-4">
  
        </div>

      <?php 
      for ($j=0; $j <= 2 && $i<$n; $j++) : ?>
        <div class='col-sm-12 col-md-6 col-lg-3 mb-4'>
          <div class='card'>
            <a href='details.php?id= <?=$id_produk[$i]?>'>
                <img src='./assets/img/product/<?=$foto[$i]?>' class='card-img-top'>
            </a>
            <div class='card-body'>
              <h7 class='card-title judul'><a class='link' href='details.php?id= <?=$id_produk[$i]?>'> <?=$nama_produk[$i]?> </a></h7>
              <p class='card-text judul'> <?=$warna[$i]?> </p>
              <a class='btn btn-light rounded-0 price'> <?=$harga[$i]?> </a>
              <a href='details.php?id= <?=$id_produk[$i]?>' class='btn btn-outline-dark btn-sm rounded-0'>Buy</a>
            </div>
          </div>
        </div>

      <?php $i++; endfor; $a++; ?>
    <?php endfor; ?>

      </div>
    </div>
     <!--Akhir Catalog -->













    <!-- Pagination --
<?php //include('includes/pagination.php'); ?>
    !-- Akhir Pagination -->






  <?php include('includes/footer.php'); ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/jQuery/jquery-3.4.1.slim.min.js"></script>
    <script src="assets/jQuery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/popperjs/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>


    <!-- JQuery Script -->
    <script type="text/javascript" src="assets/jquery/jquery.js"></script>

    
  </body>

  <!-- JQuery Codes-->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#more').click(function(){
        $('.category').show();  
        $('.more').hide();
      });
    });
  </script>




</html>