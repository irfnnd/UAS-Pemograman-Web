<?php
session_start();
include '../dataTransaksi/koneksi.php'; // Menggunakan file koneksi.php untuk koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query SQL untuk memeriksa login
    $sql = "SELECT * FROM users WHERE username = ? AND password_hash = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    // Eksekusi query
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Periksa apakah user ditemukan
    if ($result->num_rows == 1) {
        // Jika user ditemukan, set session untuk menyimpan status login
        $_SESSION['username'] = $username;
        header("Location: ../index.php"); // Arahkan ke halaman dashboard jika login sukses
        exit();
    } else {
        // Jika user tidak ditemukan, tampilkan pesan error
        echo "Username atau password salah.";
    }
}
?>
