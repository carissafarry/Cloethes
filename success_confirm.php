<?php 

  require_once 'session.php';

  if( !isset($_SESSION['cloethes']) ) {
    if( !isset($_POST['send']) ) {
      header("Location: orders.php");
      exit;
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

  <div class="container thankyou-container">
    <h3>Confirmation Delivered!</h3>
    <h5>On receiving the order, please wait at least 24 hours to allow the delivery information to be updated on your personal account. Once it has been updates, you will be able to request the return of your purchase.</h5>

    <a href="orders.php" class="btn vieworder-btn">
      Back to my orders.
    </a>

  </div>

<?php include('includes/footer.php'); ?>
<?php include('includes/scripts.php'); ?>

  </body>

<script>

</script>

</html>