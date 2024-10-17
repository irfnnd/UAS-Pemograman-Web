<?php
include 'koneksi.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $keterangan = $_POST['keterangan'];
    $total_transaksi = $_POST['total_transaksi'];

    if (!empty($id)) {
        // Update record
        $query = "UPDATE tabel_transaksi SET tgl_transaksi = '$tgl_transaksi', keterangan = '$keterangan', total_transaksi = $total_transaksi WHERE id = $id";
    } else {
        // Insert new record
        $query = "INSERT INTO tabel_transaksi (tgl_transaksi, keterangan, total_transaksi) VALUES ('$tgl_transaksi', '$keterangan', $total_transaksi)";
    }

    if ($conn->query($query) === TRUE) {
        $action = !empty($id) ? "updated" : "added";
        header("Location: index.php?status=success&action=$action"); // Redirect back to the main page with status and action
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
