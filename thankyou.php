<?php

require_once 'session.php';

if (!isset($_SESSION['cloethes'])) {
  if (!isset($_POST['checkout'])) {
    if ($redirect_to != 'cart.php') {
      header("Location: cart.php");
      exit;
    }
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('includes/header.php'); ?>
  <link rel="stylesheet" href="css/thankyou.css">


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



  <div class="container thankyou-container">
    <h3>Order Delivered!</h3>
    <h3>Thank You for Buying Our Product!</h3>

    <a href="orders.php" class="btn vieworder-btn">
      View my order
    </a>

  </div>

  <?php include('includes/footer.php'); ?>
  <?php include('includes/scripts.php'); ?>

</body>

<script>

</script>

</html>