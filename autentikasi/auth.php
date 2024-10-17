<?php
session_start();

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLoggedIn() {
    return isset($_SESSION['username']);
}

// Periksa apakah pengguna sudah login, jika belum arahkan ke halaman login
if (!isLoggedIn()) {
    header("Location: ../login.php");
    exit();
}
?>
