<?php 

  require_once 'function.php';

  $query = "
    SELECT * FROM produk
  ";
  $tables = query($query);
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
  //$nwarna = count($tables);

  // query tabel anggota
  $query2 = "SELECT * FROM anggota";
  $tables2 = query($query2);

  $i = 1;
  foreach ( $tables2 as $row2 ){
    $id_anggota[] = $row2["id_anggota"];
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
    
    <!-- Carousel -->
    <div id="carouselExampleControls" class="carousel slide pb-4 pt-4" data-ride="carousel">
      <div class="carousel-inner">
        <h6 class="text-center pb-2" id="nowtrending"> now trending </h6>


        <div class="carousel-item active">
          <div class="container">
            <div class="row">
            
            <?php $i = 0;
            for ($j=0; $j<4; $j++) : ?>
              <div class='col small'>
                <div class='card'>
                  <a href='details.php?id= <?=$id_produk[$i]?>'>
                      <img src='./assets/img/product/<?=$foto[$j]?>' class='card-img-top'>
                  </a>
                  <div class='card-body'>
                    <h7 class='card-title m-1'><a class='link' href='details.php?id= <?=$id_produk[$i]?>'> <?=$nama_produk[$j]?> </a></h7>
                    <p class='card-text m-1'> <?=$warna[$j]?> </p>
                    <a class='btn btn-light rounded-0 price'> <?=$harga[$j]?> </a>
                    <a href='details.php?id= <?=$id_produk[$i]?>' class='btn btn-outline-dark btn-sm rounded-0'>Buy</a>
                  </div>
                </div>
              </div><br>  

            <?php $i++; endfor; ?>

            </div>
          </div>
        </div>



        <?php
        $a = 0;
        $i = 4;

        while ($a < 2 && $i < 8):?>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
            
            <?php
            for ($j=4 ; $j <= 7 && $i<8; $j++) : ?>
              <div class='col-3 small'>
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
          </div>
        </div>
      </div>
    <!-- Akhir Carousel -->


    <!-- Carousel Control Prev-Next -->
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  <!-- Akhir Carousel Catalog -->



  <!-- Catalog -->
    <div class="container mt-4">
      <h6 class="text-center pb-4" id="catalog">catalog</h6>
      <div class="row mb-4">

    <?php include 'includes/products-navbar.php'; ?>

    <?php
    $a = 0;
    $i = 0;

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
      <div class="row mb-4" >
        <div class="col-3 mb-4">
  
        </div>

      <?php 
      for ($j=0; $j <= 2 && $i<$n; $j++) : ?>
        <div class='col-sm-12 col-md-6 col-lg-3 mb-4' >
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