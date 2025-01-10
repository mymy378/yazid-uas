<?php
// Ganti dengan pengaturan database Anda
$host = "localhost";
$username = "root";
$password = "";
$dbname = "pembelian_tiket_kereta";

// Koneksi ke database
$mysqli = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
