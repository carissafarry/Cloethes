<?php
require_once 'function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/index.css">


  <title>c l o e t h e s</title>
  <link href="assets/img/page/logo.png" rel="shortcut icon">

</head>

<body>

  <?php include 'includes/navbar.php'; ?>

  <!-- Jumbotron -->
  <div class="jumbotron header text-center">
    <h1 class="text-center mt-5 pt-4">.C L O E T H E S.</h1><br>
    <h4 class="text-center pb-5">By Carissa Farry</h4>
    <div class="card bg-transparent text-center outline-light mt-5 mb-3">
      <div class="card-body">
        <p class="card-text">new arrivals</p>
        <a class="card-link text-white pb-4 more" href="products.php">more&raquo;</a>
      </div>
    </div>
    <a class="her btn btn-outline-dark rounded-0 float-right mr-5" href="products.php">her</a>
    <p class="customer">
      <a class="link" href="products.php">now trending&raquo;</a>
    </p>
  </div>
  <!-- Akhir Jumbotron -->



  <!-- Catalog Big Picture -->
  <div class="container jumbotron-home">
    <div class="row">
      <div class="col-6 one-img">
        <a href="products.php">
          <img src="assets/img/page/home/01.jpg" class="home-pic">
          <p class="home-capt small link">Shop Women Spring Week</p>
        </a>
      </div>

      <div class="col-6 one-img">
        <a href="products.php">
          <img src="assets/img/page/home/02.jpg" class="home-pic">
          <p class="home-capt small link">Shop Women Spring Week</p>
        </a>
      </div>
    </div>
  </div>
  <!-- End of Catalog Grid Pic -->



  <!-- Catalog Grid Pic -->
  <section class="home-grid">
    <div class="container grid-home-container">

      <div class="container-grid">
        <?php
        /*
        for ($i=0; $i <2 ; $i++) { 
          img_grid($i);
        }
      */
        for ($j = 1; $j < 4; $j++) {
          for ($i = 0; $i < 10; $i++) {
            img_grid($j);
          }
        }

        ?>

      </div>


      <div class="caption-grid"></div>


    </div>

  </section>
  <!-- End ofCatalog Grid Pic -->


  <?php include('includes/footer.php'); ?>

  <?php include('includes/scripts.php'); ?>

</body>
</body>

</html>