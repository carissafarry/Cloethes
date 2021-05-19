<?php

//session_start(); // harus disertakan agar dapat meng-link ke page lainnya

require_once 'session.php';
require_once 'function.php';

$anggota = query("SELECT * FROM anggota");
?>

<!-- Navbar -->
<nav class="navbar nav-dekstop navbar-expand-lg navbar-light mt-2 bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="index.php">c l o e t h e s</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link sale pt-0" href="products.php">sale</a>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        <ul style="margin-top: -1px;">
          <select class="nav-link menu border-0 bg-transparent dollar" style="outline: none;">
            <option value="IDR" selected="selected">IDR</option>
            <!--
                <option value="SGD">SGD</option>
              -->
          </select>
        </ul>
        <?php
        if (isset($_SESSION["api_login"])) {
          $url = 'orders.php';
        } else {
          $url = 'myaccount.php';
        }
        ?>
        <a class="nav-item nav-link menu" name="myaccount" href="<?= $url; ?>">my account</a>

        <a class="nav-item nav-link menu" name="cart" href="cart.php">shopping bag
          <?php
          if (isset($_SESSION['cart'])) {
            $count = 0;
            foreach ($_SESSION['cart'] as $row2) {
              $count += $row2['quantity'];
            }
            echo "
                  <span>($count)</span>
                ";
          } else {
            echo "
                  <span>(0)</span>
                ";
          }
          ?>
        </a>
        <ul class="list-inline social-buttons">

          <li class="list-inline-item">

            <form action="searching.php" method="get">
              <div class="search">
                <input type="text" placeholder=" " name="keyword">
                <div>
                  <svg style="margin-top: 12px;">
                    <use xlink:href="#path">
                  </svg>
                </div>
              </div>
            </form>
            <!--
                <a href="myaccount.php">
                  <i class="far fa-user small link"></i>
                </a>
-->
          </li>

          <li class="list-inline-item">

            <?php if (isset($_SESSION["cloethes"])) : ?>
              <a href="logout.php">
                <i class="fas fa-sign-out-alt ml-3 mt-2 small"></i>
              </a>
            <?php else : ?>
              <a href="login.php">
                <i class="fas fa-sign-in-alt ml-3 mt-3 small"></i>
              </a>
            <?php endif; ?>

          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- Akhir Navbar -->



<svg xmlns="http://www.w3.org/2000/svg" style="display: none; ">
  <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 28" id="path">
    <path d="M32.9418651,-20.6880772 C37.9418651,-20.6880772 40.9418651,-16.6880772 40.9418651,-12.6880772 C40.9418651,-8.68807717 37.9418651,-4.68807717 32.9418651,-4.68807717 C27.9418651,-4.68807717 24.9418651,-8.68807717 24.9418651,-12.6880772 C24.9418651,-16.6880772 27.9418651,-20.6880772 32.9418651,-20.6880772 L32.9418651,-29.870624 C32.9418651,-30.3676803 33.3448089,-30.770624 33.8418651,-30.770624 C34.08056,-30.770624 34.3094785,-30.6758029 34.4782612,-30.5070201 L141.371843,76.386562" transform="translate(83.156854, 22.171573) rotate(-225.000000) translate(-83.156854, -22.171573)"></path>
  </symbol>
</svg>