<?php

	// koneksi ke database (secara secure dengan mysqli_select_db())
	require_once 'database/dbconfig.php';

	// fungsi query
	function query($query) {
		global $conn;
		$result = mysqli_query($conn, $query);
		$rows = [];
		while( $row = mysqli_fetch_assoc($result) ) {
			$rows[] = $row; // setiap variabel pada row, akan disimpan ke variabel array rows
		}
		return $rows;
	}



////// HALAMAN USER ADMIN ///////////
	// fungsi untuk mengupload foto



	// fungsi untuk menghapus data dari teks link hapus.php
	function delete($id) {
		global $conn;
		mysqli_query($conn, "DELETE FROM user_admin WHERE id_admin = $id");
		return mysqli_affected_rows($conn);
	}



	// fungsi untuk ubah/update data dari ubah.php
	function edit($data){
		global $conn;

		$id = $data["id_admin"];

		// simpan data, hilangkan karakter backslash dkk, kecilkan huruf
		$username = htmlspecialchars($data["edit_username"]);
		$password = htmlspecialchars($data["edit_password"]);
		$usertype = htmlspecialchars($data["usertype"]);
		//$password = htmlspecialchars($data["password"]);

		$password = password_hash($password, PASSWORD_DEFAULT);

		// query update data
		$query = "UPDATE user_admin SET
			  username = '$username',
			  password = '$password',
			  usertype = '$usertype'

			WHERE id_admin = $id
			 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



	// function untuk searching box
	function cari($keyword) {
		global $conn;
		$query = "SELECT * FROM anggota
				WHERE
				  username LIKE '%$keyword%' OR
				  email LIKE '%$keyword%' OR
				  nama LIKE '%$keyword%' OR
				  no_telp LIKE '%$keyword%'
				 ";
		return query($query); // hasil berupa array assosiative, disimpan pada $table di index.php
	}



	// function untuk registrasi customer dan admin
	function registrasi_admin($data) {
		global $conn;

		// simpan data, hilangkan karakter backslash dkk, kecilkan huruf
		$username = strtolower( stripslashes($data["username"]) );
		$password = mysqli_real_escape_string($conn, $data["password"]);
		$password2 = mysqli_real_escape_string($conn, $data["password2"]);
		$usertype = htmlspecialchars($data["usertype"]);
		

		// cek username sudah ada atau belum
		$result = mysqli_query($conn, "SELECT username FROM user_admin WHERE username = '$username'");
		if( mysqli_fetch_assoc($result) ) { // bila bernilai true, username ada yang sama 
			echo "<script>
					alert('Username yang diketik telah terdaftar!');
				 </script>";
			return false;
		}

		// cek konfirmasi password
		if( $password !==  $password2 ) {
			echo "<script>
					alert('Konfirmasi password tidak sesuai!');
				</script>";
			return false;
		}

		// enkripsi password
		$password = password_hash($password, PASSWORD_DEFAULT); // password_default akan memakai algoritma teraman yang ada saat ini & akan diperbarui

		// tambah user baru ke db
		$query = "INSERT INTO user_admin
				VALUES ('', 
					    '$username',
				    	'$password',
				    	'$usertype'
				)";
			
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn); // 1 jika berhasil, -1 jika gagal
	}



/////// HALAMAN ABOUT US ///////
	// fungsi untuk menambah data page about us
	function addpage($data) {
		global $conn;

		$pagename = strtolower( stripslashes($data["pagename"]) );
		//$pagename = htmlspecialchars($data["pagename"]);
		$title = htmlspecialchars($data["title"]);
		$desc_page = htmlspecialchars($data["desc_page"]);
		$page_link = htmlspecialchars($data["page_link"]);


		// cek pagename page sudah ada atau belum
		$result = mysqli_query($conn, "SELECT pagename FROM about_us WHERE pagename = '$pagename'");
		if( mysqli_fetch_assoc($result) ) { // bila bernilai true, username ada yang sama 
			echo "<script>
					alert('Pagename yang diketik telah terdaftar!');
				 </script>";
			return false; 
		}
		

		$query = "INSERT INTO about_us
					VALUES
				  ('', '$pagename', '$title', '$desc_page', '$page_link')
				  ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



	// fungsi untuk menghapus data dari teks link hapus.php
	function pagedelete($id) {
		global $conn;

		$data = htmlspecialchars($id["id"]);
		mysqli_query($conn, "DELETE FROM about_us WHERE id_page = '$data'");
		return mysqli_affected_rows($conn);
	}



	// fungsi untuk edit data about us
	function aboutus_edit($data) {
		global $conn;

		$id = $data["id_page"];

		// simpan data, hilangkan karakter backslash dkk, kecilkan huruf
		$title = htmlspecialchars($data["title"]);
		$desc = htmlspecialchars($data["desc"]);
		$link = htmlspecialchars($data["link"]);

		// query update data
		$query = "UPDATE about_us SET
			  title = '$title',
			  desc_page = '$desc',
			  link = '$link'

			WHERE id_page = $id
			 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



///// HALAMAN KATEGORI ///////
	// fungsi untuk menambah data page categories
	function addcategory($data) {
		global $conn;

		$name = strtolower( stripslashes($data["name_cat"]) );
		$desc = htmlspecialchars($data["desc_cat"]);


		// cek username page sudah ada atau belum
		$result = mysqli_query($conn, "SELECT nama_kategori FROM kategori WHERE nama_kategori = '$name'");
		if( mysqli_fetch_assoc($result) ) { // bila bernilai true, username ada yang sama 
			echo "<script>
					alert('Nama kategori yang diketik telah terdaftar!');
				 </script>";
			return false; 
		}
		

		$query = "INSERT INTO kategori
					VALUES
				  ('', '$name', '$desc')
				  ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}


	// fungsi untuk menghapus data dari teks link hapus.php
	function categories_delete($id) {
		global $conn;

		$data = htmlspecialchars($id["id"]);
		mysqli_query($conn, "DELETE FROM kategori WHERE id_cat = '$data'");
		return mysqli_affected_rows($conn);
	}



	// fungsi untuk edit data kategori
	function category_edit($data) {
		global $conn;

		$id = $data["id_cat"];

		// simpan data, hilangkan karakter backslash dkk, kecilkan huruf
		$name = htmlspecialchars($data["name_cat"]);
		$desc = htmlspecialchars($data["desc_cat"]);

		// query update data
		$query = "UPDATE kategori SET
			  nama_kategori = '$name',
			  deskripsi_kategori = '$desc'

			WHERE id_cat = $id
			 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}







///// HALAMAN PRODUK ////

	function addproduct($data) {
		global $conn;

		$idKat = htmlspecialchars($data["idKategori"]);
		$nama = htmlspecialchars($data["namaProduk"]);
		$warna = htmlspecialchars($data["warna"]);
		$ukuran = htmlspecialchars($data["ukuran"]);
		$stok = htmlspecialchars($data["stok"]);
		$harga = htmlspecialchars($data["harga"]);
		$deskripsi = htmlspecialchars($data["deskripsi"]);


		// cek nama produk yang sama
		$result = mysqli_query($conn, "SELECT nama_produk FROM produk WHERE nama_produk = '$nama'");

		if( mysqli_fetch_assoc($result) ) { // bila bernilai true, nama produk ada yang sama 
			echo "<script>
					alert('Nama produk yang diketik telah terdaftar!');
				 </script>";
			return false; 
		}

		// upload gambar
		$foto = upload();
		if( !$foto ) {
			return false;
		}
		$tmpName = $_FILES['foto']['tmp_name'];
		move_uploaded_file($tmpName, '../assets/img/product/' . $foto);

		$query = "INSERT INTO produk
					VALUES
				  ('', '$idKat', '$nama', '$foto', '$warna', '$ukuran', '$stok', '$harga', '$deskripsi', '')
				 ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
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



	function productdelete($id) {
		global $conn;

		$data = htmlspecialchars($id["id"]);
		mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$data'");
		return mysqli_affected_rows($conn);
	}



	function productchosen_status($data) {
		global $conn;

		$id = $data["id_chosen"];
		$status = $data["status"];
		// query update data
		$query = "UPDATE produk SET
				  status = '$status'

				WHERE id_produk = $id
				 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



	function productchosen_delete($data) {
		global $conn;

		$x = "1";

		mysqli_query($conn, "DELETE FROM produk WHERE status = '$x'");
		return mysqli_affected_rows($conn);
	}



	function product_edit($data){
		global $conn;

		$id = $data["id_produk"];
		$idKat = htmlspecialchars($data["idKategori"]);
		$nama = htmlspecialchars($data["namaProduk"]);
		$warna = htmlspecialchars($data["warna"]);
		$ukuran = htmlspecialchars($data["ukuran"]);
		$stok = htmlspecialchars($data["stok"]);
		$harga = htmlspecialchars($data["harga"]);
		$deskripsi = htmlspecialchars($data["deskripsi"]);

		$fotoLama = htmlspecialchars($data["fotoLama"]);

		// cek apakah user pilih foto baru atau tidak
		if( $_FILES['foto']['error'] === 4 ) { 
			$foto = $fotoLama;
		} else {
			$foto = upload();
			$tmpName = $_FILES['foto']['tmp_name'];
			move_uploaded_file($tmpName, '../assets/img/product/' . $foto);
		}

		// query update data
		$query = "UPDATE produk SET
				  id_kategori = '$idKat',
				  nama_produk = '$nama',
				  foto = '$foto',
				  warna = '$warna',
				  ukuran = '$ukuran',
				  stok = '$stok',
				  harga = '$harga',
				  deskripsi_produk = '$deskripsi'

				WHERE id_produk = $id
				 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}




//// HALAMAN USER /////
	// function untuk registrasi customer
	function adduser($data) {
		global $conn;
		//global $tmpName;

		// simpan data, hilangkan karakter backslash dkk, kecilkan huruf
		$username = strtolower( stripslashes($data["username"]) );
		$email = htmlspecialchars($data["email"]);
		$nama = htmlspecialchars($data["nama"]);
		$ttl = htmlspecialchars($data["ttl"]);
		$address = htmlspecialchars($data["address"]);
		$country = htmlspecialchars($data["country"]);
		$currency = htmlspecialchars($data["currency"]);
		$telp = htmlspecialchars($data["telp"]);
		$usertype = htmlspecialchars($data["usertype"]);


		$password = mysqli_real_escape_string($conn, $data["password"]);
		$password2 = mysqli_real_escape_string($conn, $data["password2"]);

		// cek username sudah ada atau belum
		$result = mysqli_query($conn, "SELECT username FROM anggota WHERE username = '$username'");
		if( mysqli_fetch_assoc($result) ) { // bila bernilai true, username ada yang sama 
			echo "<script>
					alert('Username yang diketik telah terdaftar!');
				 </script>";
			return false;
		}

		// cek email sudah ada atau belum
		$result = mysqli_query($conn, "SELECT email FROM anggota WHERE email = '$email'");
		if( mysqli_fetch_assoc($result) ) { // bila bernilai true, username ada yang sama 
			echo "<script>
					alert('Email yang diketik telah terdaftar!');
				 </script>";
			return false;
		}

		// cek konfirmasi password
		if( $password !==  $password2 ) {
			echo "<script>
					alert('Konfirmasi password tidak sesuai!');
				</script>";
			return false;
		}

		// filter dan validasi email
		if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
			echo "<script>
					alert('Format email tidak sesuai!');
				</script>";
			return false;
		}

		// upload gambar
		$foto = upload();
		if( !$foto ) {
			return false;
		}
		$tmpName = $_FILES['foto']['tmp_name'];
		move_uploaded_file($tmpName, '../assets/img/member/' . $foto);

		// tambah user baru ke db
		$query = "INSERT INTO anggota
				VALUES ('', 
					    '$username',
					    '$email',
				    	'$password',
				    	'$foto',
				    	'$nama',
				    	'$ttl',
				    	'$address',
				    	'$country',
				    	'$currency',
				    	'$telp',
				    	'$usertype',
				    	''
				)";
			
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn); // 1 jika berhasil, -1 jika gagal
	}



	function deleteuser($id) {
		global $conn;

		$data = htmlspecialchars($id["id"]);
		mysqli_query($conn, "DELETE FROM anggota WHERE id_anggota = '$data'");
		return mysqli_affected_rows($conn);
	}



	function userschosen_status($data) {
		global $conn;

		$id = $data["id_chosen"];
		$status = $data["status"];
		// query update data
		$query = "UPDATE anggota SET
				  status = '$status'

				WHERE id_anggota = $id
				 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}



	function userschosen_delete($data) {
		global $conn;

		$x = "1";
		mysqli_query($conn, "DELETE FROM anggota WHERE status = '$x'");
		return mysqli_affected_rows($conn);
	}



	function user_edit($data){
		global $conn;

		$id = $data["id"];
		$email = htmlspecialchars($data["email"]);
		$nama = htmlspecialchars($data["nama"]);
		$ttl = htmlspecialchars($data["ttl"]);
		$address = htmlspecialchars($data["address"]);
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

		// query insert data
		$query = "UPDATE anggota SET
				  email = '$email',
				  password = '$password',
				  foto = '$foto',
				  nama = '$nama',
				  tgl_lahir = '$ttl',
				  alamat = '$address',
				  negara = '$country',
				  mata_uang = '$currency',
				  no_telp = '$telp'

				WHERE id_anggota = $id
				 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}


	function update_resi($data) {
		global $conn;

		$id = htmlspecialchars($data["id_order"]);
		$resi = htmlspecialchars($data["resi"]);
		$status = htmlspecialchars($data["status"]);

				// query insert data
		$query = "UPDATE invoice_order SET
				  paid = '$status',
				  shipping_num = '$resi'
				WHERE id_order = '$id'
				 ";

		// jalankan query
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);

	}

?>