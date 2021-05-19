// ambil elemen yang dibutuhkan 
var keyword = document.getElementById('keyword'); 
// cari elemen dengan id keyword dalam dokumen, masukkan ke variabel keyword
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');


// tambahkan event (aksi) ketika keyword ditulis
keyword.addEventListener('keyup', function() {
	// ambil apapun keyword yang diinput user pada variabel keyword


	// buat object ajax
	var ajax = new XMLHttpRequest();

	// cek apakah ajax ready
	ajax.onreadystatechange = function() {
		if( ajax.readyState == 4 && ajax.status == 200 ) { // 4 ajax sudah siap
			container.innerHTML = ajax.responseText; // ganti isi div container dg apapun isi dari xhr yaitu isi file coba.txt
		}
	}

	// eksekusi ajax
	// kirimkan input user ke file data anggota.php
	ajax.open('GET', 'ajax/anggota.php?keyword=' + keyword.value, true); // parameter: method, sumber, sinkron/ansinkron
	ajax.send();
});