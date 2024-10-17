<?php
include 'koneksi.php'; // Your database connection file

$id = $_POST['id'];
$nama = $_POST['nama'];
$ttl = $_POST['ttl'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$posisi = $_POST['posisi'];
$gaji = $_POST['gaji'];

if (!empty($id)) {
    // Update record
    $query = "UPDATE tabel_karyawan SET nama='$nama', ttl='$ttl', alamat='$alamat', no_telp='$no_telp', jenis_kelamin='$jenis_kelamin', posisi='$posisi', gaji='$gaji' WHERE id='$id'";
} else {
    // Insert new record
    $query = "INSERT INTO tabel_karyawan (nama, ttl, alamat, no_telp, jenis_kelamin, posisi, gaji) VALUES ('$nama', '$ttl', '$alamat', '$no_telp', '$jenis_kelamin', '$posisi', '$gaji')";
}

if ($conn->query($query) === TRUE) {
    header("Location: index.php"); // Redirect back to the main page
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
