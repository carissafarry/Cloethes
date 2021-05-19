<?php 
require_once 'session.php';
?>
<div class="col-md-4 myaccount-side">
  <ul class="ul-cart-side">
<!--
    <li>
      <a href="myaccount.php" class="link">dashboard</a>
    </li>
-->
    <?php 
    if(!isset($_SESSION['api_login']) ) {
      echo'
        <li>
          <a href="myaccount.php" class="link">dashboard</a>
        </li>
      ';
    }

    ?>
    <li>
      <a href="orders.php" class="link">my orders</a>
    </li>
<!--
    <li>
      <a href="" class="link">voucher</a>
    </li>
-->
    <li>
      <a href="logout.php" class="link">logout</a>
    </li>
  </ul>
</div>