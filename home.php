<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_btgfotocopy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data jumlah barang
$sql = "SELECT COUNT(*) as jumlah FROM tabel_barang";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$jumlahBarang = $row['jumlah'];

// Mengambil data jumlah transaksi
$sql = "SELECT SUM(total_transaksi) AS totalTransaksi FROM tabel_transaksi";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalTransaksi = $row['totalTransaksi'];
} else {
    $totalTransaksi = 0; // Jika tidak ada data transaksi
}

// Mengambil data jumlah karyawan
$sql = "SELECT COUNT(*) as jumlah FROM tabel_karyawan";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$jumlahKaryawan = $row['jumlah'];

// Mengambil data jumlah user
$sql = "SELECT COUNT(*) as jumlah FROM users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$jumlahUsers = $row['jumlah'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Dashboard</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 1px auto;
            padding: 25px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 30px;
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
            margin-top: 0;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            flex: 0 0 calc(25% - 10px);
            background: #fff;
            margin: 10px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            text-align: center;
            color: #fff;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card .card-header {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .card .card-body {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .card .card-footer {
            background-color: rgba(0, 0, 0, 0.05);
            padding: 8px;
            border-radius: 10px;
        }
        .card .card-footer:hover {
            background-color: #252639;
            transition: 0.5s;
        }
        .card a {
            color: #fff;
            text-decoration: none;
            font-size: 15px;
        }

        .bg-primary {
            background-color: #3498db;
        }

        .bg-success {
            background-color: #2ecc71;
        }

        .bg-warning {
            background-color: #f1c40f;
        }

        .bg-danger {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
        <div class="card bg-success">
                <div class="card-header">
                    <i class="fas fa-shopping-cart"></i> Jumlah Total Transaksi
                </div>
                <div class="card-body">
                    <?php echo "Rp"  . number_format($totalTransaksi, 2, ',', '.') . ' '; ?>
                </div>
                <div  class="card-footer ">
                    <a href="dataTransaksi/index.php" >More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="card bg-primary">
                <div class="card-header">
                    <i class="fas fa-box"></i> Jumlah Barang
                </div>
                <div class="card-body">
                    <?php echo $jumlahBarang; ?>
                </div>
                <div class="card-footer">
                    <a href="dataBarang/index.php">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="card bg-warning">
                <div class="card-header">
                    <i class="fas fa-users"></i> Jumlah Karyawan
                </div>
                <div class="card-body">
                    <?php echo $jumlahKaryawan; ?>
                </div>
                <div class="card-footer">
                    <a href="dataKaryawan/index.php">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="card bg-danger">
                <div class="card-header">
                    <i class="fas fa-user"></i> Jumlah Users
                </div>
                <div class="card-body">
                    <?php echo $jumlahUsers; ?>
                </div>
                <div class="card-footer">
                    <a href="dataUsers/index.php">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <script>

    function showHome() {
      document.getElementById("main").innerHTML = `
                <iframe src="home.php" width="100%" height="100%" frameborder="0"></iframe>
            `;
    }
    function showDatabarang() {
      document.getElementById("main").innerHTML = `
                <iframe src="dataBarang/index.php" width="100%" height="100%" frameborder="0"></iframe>
            `;
    }
    function showDatakaryawan() {
      document.getElementById("main").innerHTML = `
                <iframe src="dataKaryawan/index.php" width="100%" height="100%" frameborder="0"></iframe>
            `;
    }
    function showDatatransaksi() {
      document.getElementById("main").innerHTML = `
                <iframe src="dataTransaksi/index.php" width="100%" height="100%" frameborder="0"></iframe>
            `;
    }
    function showDatausers() {
      document.getElementById("main").innerHTML = `
                <iframe src="dataUsers/index.php" width="100%" height="100%" frameborder="0"></iframe>
            `;
    }


    function setActive(element) {
      // Select all links
      const navLinks = document.querySelectorAll(".nav-link");

      // Remove active class from all links
      navLinks.forEach((link) => link.classList.remove("active"));

      // Add active class to the clicked link
      element.classList.add("active");
    }
  </script>
</body>
</html>
