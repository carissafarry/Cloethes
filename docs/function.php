<?php

	// koneksi ke database (secara secure dengan mysqli_select_db())
	require_once 'session.php';
	require_once 'admin/database/dbconfig.php';
	

	// fungsi query
	function query($request) {
		global $conn;

		$result = mysqli_query($conn, $request);
		$rows = [];
		while( $row = mysqli_fetch_assoc($result) ) {
			$rows[] = $row; // setiap variabel pada row, akan disimpan ke variabel array rows
		}
		return $rows;
	}


	function addtocart($data) { // buat variabel baru dari produk keranjang yang dipilih
		global $conn;

		// produk yang dipilih di tampung terlebih dahulu pada sebuah variabel
		$item_array = array(
		  'id_produk' => $data['id_pcart'],
		  'nama' => $data['nama'],
		  'quantity' => $data['qty'],
		  'ukuran' => $data['size']
		);

		return $item_array;		
	}

	function update_product($data) {
		global $conn;
		//var_dump($data);
		
		$data['quantity'] += 1;

		$item_array = array(
		  'id_produk' => $data['id_produk'],
		  'nama' => $data['nama'],
		  'quantity' => $data['quantity'],
		  'ukuran' => $data['ukuran']
		);

		return $item_array;		

	}

	function make_array($data) {
		global $conn;
		
		
		// menjadikan beberapa data ke dalam satu variabel array
		$item_array = array(
		  'id_produk' => $id,
		  'nama' => $name,
		  'foto' => $img,
		  'quantity' => $qty,
		  'price' => $price,
		  'ukuran' => $size
		);

		return $item_array;
		
	}


//	function cart_product($data, $qty, $size) {
	function cart_product($id, $name, $img, $qty, $price, $size) {
		global $conn;
		
		$qty2 = (int) $qty;

		echo "
	      <tr class='data-cart-row'>
            <td class='product-remove'>
              <a href='cart.php?id_remove=$id' class='remove link' name='product-remove'> x
              </a>
            </td>
            
            <td class='product-thumbnail'>
              <a href='assets/img/product/$img'>
                <img width='85' src='assets/img/product/$img'>
              </a>
            </td>

            <td class='product-name'>
              <a href='details.php?id=$id' class='link'>
                $name
              </a>
            </td>

            <td class='product-price'>
              <div class='_flex-col _h-center'>
                $price
              </div>
            </td>

            <td class='product-quantity quantity'>
              <input type='number' class='qty' id='qty' name='qty' min='1' max='20' value='$qty2'>

<!--
              <button type='button' class='btn bg-0 border-0 qty-btn'>
                <i class='fas fa-minus'></i>
              </button>

              <input type='text' value='1' class='form-control w-17 d-inline quantity-input border-0' name='qty'>

              <button type='button' class='btn bg-0 border-0 qty-btn'>
                <i class='fas fa-plus'></i>
              </button>
-->

            </td>

            <td class='product-subtotal _text-right'>
              $price
            </td>
          </tr>
		";
	}


	// fungsi menambahkan data keranjang yang di-checkout ke database
	function insertcart_db($session, $item, $date, $time,$total) {
		global $conn;
		
		$query = "SELECT * FROM anggota WHERE username = '$session' ";
		$result = mysqli_query($conn, $query);

		if( $row2 = mysqli_fetch_assoc($result) ) {
	  		$id_user = $row2['id_anggota'];
	  		$user_name = $row2['username'];
	  		$address = $row2['alamat'];
  		}

  		if (isset($_SESSION["api_login"]) ) {
  			$user_data = $session;
  		} else {
  			$user_data = $user_name;
  		}

  		// masukkan data pada keranjang, ke tabel pemesanan di database
  		$qty_total = 0;
  		$total_bayar = 0;
  		$i = 0;
  		
			
		$query2 = "INSERT INTO order_data
		VALUES ('',
				'$user_data',
				'$date',
				'$time',
				'$address',
				'$total',
			    ''	
		)";
		mysqli_query($conn, $query2);
		
		// mendapatkan id dari baris yang baru dimasukkan ke database
		$last_id = $conn->insert_id;

		foreach ($item as $key => $row) {
  			//$id_produk[] = $row["id_produk"];
  			$id_p = $row["id_produk"];
  			$id_p2 = (int) $id_p;
  			$qty = $row["quantity"];

  			$query2 = "SELECT * FROM produk WHERE id_produk = $id_p2";
  			$result2 = mysqli_query($conn, $query2);

  			if( $row3 = mysqli_fetch_assoc($result2) ) {
	  			$price = $row3['harga'];
  			}
			
	  		$query3 = "INSERT INTO invoice_order
			VALUES ('',
					'$last_id',
					'$id_p2',
					'$qty',
					'$price',
					'pending',
					''
			)";
			mysqli_query($conn, $query3);
			unset($_SESSION['cart'][$key]);
			$i++;
		}
		
		//return $last_id;
		return mysqli_affected_rows($conn); // 1 jika berhasil, -1 jika gagal
	}

	function img_grid($i){
		global $conn;

		/*
		$query = "SELECT * FROM produk";
  		$result = mysqli_query($conn, $query);
  		
		while ( $row = mysqli_fetch_assoc($result) ) {

			$img[] = $row['foto'];
  			//var_dump($img);
  		}
  			
		  echo '
			<div class="item-grid">
	          <a href="products.php" class="link-grid">
	            <img src="assets/img/product/$img[$index]" class="img-grid">
	          </a>
	        </div>
          ';
         */

        if ($i == 1) {
		  echo '
			<div class="item-grid">
	          <a href="products.php" class="link-grid">
	            <img src="assets/img/page/home/01.jpg" class="img-grid">
	          </a>
	        </div>
          ';
        } elseif ($i == 2) {
        	echo '
			<div class="item-grid">
	          <a href="products.php" class="link-grid">
	            <img src="assets/img/page/home/02.jpg" class="img-grid">
	          </a>
	        </div>
          ';
        } else {
        	echo '
			<div class="item-grid">
	          <a href="products.php" class="link-grid">
	            <img src="assets/img/page/home/03.jpg" class="img-grid">
	          </a>
	        </div>
          ';
        }
    	
	}


	function user_edit($data){
		global $conn;

		$id = $data["id"];
		$nama = htmlspecialchars($data["name"]);
		$ttl = htmlspecialchars($data["ttl"]);
		$address = htmlspecialchars($data["address"]);
/*
		$country = htmlspecialchars($data["country"]);
		$currency = htmlspecialchars($data["currency"]);
		$telp = htmlspecialchars($data["telp"]);


		$password = htmlspecialchars($data["edit_password"]);
		//$password = password_hash($password, PASSWORD_DEFAULT);
		$fotoLama = htmlspecialchars($data["fotoLama"]);

		// cek apakah user pilih foto baru atau tidak
		if( $_FILES['foto']['error'] === 4 ) { 
			$foto = $fotoLama;
		} else {
			$foto = upload();
			$tmpName = $_FILES['foto']['tmp_name'];
			move_uploaded_file($tmpName, '../assets/img/member/' . $foto);
		}
*/
		// query insert data
		if( isset($_SESSION["api_login"]) ) {
			$user = $_SESSION["api_login"];
			header('Location: products.php');
			exit;

		} else {
			$query = "UPDATE anggota SET
					  
					  nama = '$nama',
					  tgl_lahir = '$ttl',
					  alamat = '$address'
					  

					WHERE id_anggota = $id
					 ";
		}

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	function empty_order() {
		echo '
		  <div class="container thankyou-container">
		    <h3>Order Delivered!</h3>
		    <h3>Thank You for Buying Our Product!</h3>

		    <a href="invoice.php" class="btn vieworder-btn">
		      View my order
		    </a>

		  </div>


		';
	}



	function addpayment($data) {
		global $conn;

		$id_order = htmlspecialchars($data["id_order"]);
		$username = htmlspecialchars($data["username"]);
		$total_payment = htmlspecialchars($data["total_payment"]);
		$date = htmlspecialchars($data["date"]);
		$time = htmlspecialchars($data["time"]);
		$status = htmlspecialchars($data["status"]);
		$nama = htmlspecialchars($data["nama"]);
		$ttl = htmlspecialchars($data["ttl"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$bank = htmlspecialchars($data["bank"]);
		$norek = htmlspecialchars($data["norek"]);
		
		$foto = upload();
		if( !$foto ) {
			return false;
		}
		$tmpName = $_FILES['foto']['tmp_name'];
		move_uploaded_file($tmpName, 'assets/img/payment/' . $foto);

		$query = "INSERT INTO payment
					VALUES
				  ('', 
				  '$id_order', 
				  '$username', 
				  '$nama',
				  '$total_payment', 
				  '$bank', 
				  '$date', 
				  '$time', 
				  '$foto', 
				  ''
				  )";

		mysqli_query($conn, $query);
		

		// update data invoice order dan order data karena sudah terbayar dari pending ke sudah bayar

		$query2 = "
			UPDATE invoice_order
			SET paid = '$status'
			WHERE id_order = $id_order
		";
		mysqli_query($conn, $query2);

		$query3 = "
			UPDATE order_data
			SET alamat = '$alamat'
			WHERE id_order = $id_order
		";
		mysqli_query($conn, $query3);
		//return mysqli_affected_rows($conn);
		return mysqli_sqlstate($conn);
	}



	function upload() {
		global $conn;
		// 'foto' dapat dari attr name di tambah.php
		$namaFile = $_FILES['foto']['name'];
		$ukuranFile = $_FILES['foto']['size'];
		$error = $_FILES['foto']['error'];
		$tmpName = $_FILES['foto']['tmp_name'];

		// cek apakah ada foto yang diupload
		if( $error === 4 ) {
			echo "<script>
					alert('Pilih foto terlebih dahulu!');
				  </script>";
			return false;
		}

		$ekstensiFotoValid = ['jpg', 'jpeg', 'png', 'gif'];
		$ekstensiFoto = explode('.', $namaFile);
		$ekstensiFoto = strtolower( end($ekstensiFoto) ); 

		if( !in_array($ekstensiFoto, $ekstensiFotoValid) ) {
			echo "<script>
					alert('File yang diupload bukan foto!');
				  </script>";
			return false;
		}

		// cek ukuran gambar
		if( $ukuranFile > 5000000 ) {
			echo "<script>
					alert('Ukuran foto terlalu besar!');
				  </script>";
			return false;
		}

		$namaFileBaru = uniqid(); // rename acak file foto
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiFoto;

		// upload jika lolos, simpan ke direktori yang diinginkan
		//move_uploaded_file($tmpName, '../assets/img/member/' . $namaFileBaru);
		return $namaFileBaru;
	}
