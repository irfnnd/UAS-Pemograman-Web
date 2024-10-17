<?php
include 'koneksi.php'; // Your database connection file

$id = $_GET['id'];

$query = "DELETE FROM users WHERE id='$id'";

if ($conn->query($query) === TRUE) {
    header("Location: index.php"); // Redirect back to the main page
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
