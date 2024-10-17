<?php
include 'koneksi.php'; // Your database connection file

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$posisi = $_POST['posisi'];

if (!empty($id)) {
    // Update record
    $query = "UPDATE users SET nama='$nama', username='$username',  password_hash='$password', posisi='$posisi' WHERE id='$id'";
} else {
    // Insert new record
    $query = "INSERT INTO users (nama, username, password_hash, posisi) VALUES ('$nama', '$username', '$password', '$posisi')";
}

if ($conn->query($query) === TRUE) {
    header("Location: index.php"); // Redirect back to the main page
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
