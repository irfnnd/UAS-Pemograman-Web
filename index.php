<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['username']);
}

// Periksa apakah pengguna sudah login, jika belum arahkan ke halaman login
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Ambil data dari sesi
$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : '';
$posisi = isset($_SESSION['posisi']) ? $_SESSION['posisi'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bintang Fotocopy</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="assets/logo.png" />
</head>

<body>
  <div id="mySidebar" class="sidebar">
    <nav>
      <ul>
        <button href="javascript:void(0)" class="closebtn" onclick="closeNav()">
          &times;
        </button>
        <div class="logo">
          <img src="assets/Admin-Profile-Vector-PNG-Clipart.png" alt="" />
          <span><?php echo htmlspecialchars($nama); ?> <span><?php echo htmlspecialchars($posisi); ?></span></span>
        </div>
        <hr />
        <li>
          <a href="#" class="nav-link" onclick="setActive(this), showHome()">
            <i class="fas fa-home"></i>
            <span class="nav-item">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link" onclick="setActive(this), showDatabarang()">
            <i class="fas fa-dolly"></i>
            <span class="nav-item">Data Barang</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link" onclick="setActive(this),showDatakaryawan()">
            <i class="fas fa-user-tie"></i>
            <span class="nav-item">Data Karyawan</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link" onclick="setActive(this),showDatatransaksi()">
            <i class="fas fa-cash-register"></i>
            <span class="nav-item">Data Transaksi</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link" onclick="setActive(this),showDatausers()">
            <i class="fas fa-users"></i>
            <span class="nav-item">Data Users</span>
          </a>
        </li>
        <li>
          <a href="autentikasi/logOut.php" class="nav-link logout" onclick="setActive(this)">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Log out</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <div style="transition: 0.5s" class="header-main" id="header-main">
    <button class="openbtn" id="openbtn" onclick="openNav()">&#9776;</button>
    <h2 style="margin: 0; color: #000679; display: flex; align-items: center">
      <i>Bintang<span style="color: rgb(255, 149, 0)">Fotocopy</span></i>
    </h2>
    <div class="username"></div>
  </div>
  <div id="main">
    <iframe style="width: 100%;
      height: 100%;
      border: none;" src="home.php" frameborder="0"></iframe>
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
      document.getElementById("header-main").style.marginLeft = "250px";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.getElementById("header-main").style.marginLeft = "0";
    }

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
