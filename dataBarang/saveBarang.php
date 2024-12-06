<?php
include 'koneksi.php'; // Your database connection file

$id = $_POST['id'];
$kodeBarang = $_POST['kodeBarang'];
$namaBarang = $_POST['namaBarang'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
header('Content-Type: application/json');
if (!empty($id)) {
    // Update record
    $query = "UPDATE tabel_barang SET kodeBarang='$kodeBarang', namaBarang='$namaBarang', kategori='$kategori', harga='$harga'  WHERE id='$id'";
} else {
    // Insert new record
    $query = "INSERT INTO tabel_barang (kodeBarang, namaBarang, kategori, harga) VALUES ('$kodeBarang', '$namaBarang', '$kategori', '$harga')";
}

if ($conn->query($query) === TRUE) {
    header("Location: index.php"); // Redirect back to the main page
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
