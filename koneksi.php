<?php
// Konfigurasi koneksi
$host     = "localhost";
$username = "root";
$password = "";
$database = "db_praktikmkweb5a";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
