<?php
//pmb = penerimaan mahasiswa baru
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_psb";

//variabel untuk menyimpan koneksi
$koneksi = mysqli_connect($host, $username, $password, $dbname);

//kode ini berfungsi untuk memberitahu apakah koneksi database berhasil atau gagal
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
?>