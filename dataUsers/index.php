<?php require '../autentikasi/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Users</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");

        body {
            font-family: "Poppins", sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .container {
            background-color: white;
            padding: 0px 20px 20px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 80rem;
        }

        h1 {
            margin-bottom: 30px;
            text-align: center;
            font-weight: 500;
            margin-top: 0;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .toolbar .left-buttons {
            display: flex;
            align-items: center;
        }

        button.btn-add,
        button.btn-print {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-family: "Poppins", sans-serif;
            margin-right: 15px;
            font-size: 14px;
        }

        button.btn-print {
            background-color: #007bff;
        }

        button.btn-add:hover {
            background-color: #218838;
        }

        button.btn-print:hover {
            background-color: #0056b3;
        }

        .search-container {
            display: flex;
            align-items: center;
            width: 60%;
        }

        input#searchInput {
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px 0 0 8px;
            font-family: "Poppins", sans-serif;
            border-right: none;
            font-size: 14px;
        }

        button#searchButton {
            padding: 10px;
            border: 1px solid #ccc;
            border-left: none;
            background-color: #f2f2f2;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            width: 50px;
        }

        button#searchButton i {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            border-bottom: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            font-weight: 300;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        button.btn-edit,
        button.btn-delete {
            padding: 11px 10px 10px 10px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.btn-edit {
            background-color: #007bff;
            color: white;
        }

        button.btn-edit:hover {
            background-color: #0056b3;
        }

        button.btn-delete {
            background-color: #dc3545;
            color: white;
        }

        button.btn-delete:hover {
            background-color: #c82333;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            overflow: auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            width: 90%;
            border-radius: 10px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.4);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 7px;
        }

        .bottom-toolbar {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        button[type="submit"],
        button[type="reset"] {
            padding: 8px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            font-family: "Poppins", sans-serif;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        button[type="reset"] {
            background-color: #dc3545;
            color: white;
        }

        button[type="reset"]:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Users</h1>
        <div class="toolbar">
            <div class="left-buttons">
                <button id="addButton" class="btn-add">Tambahkan Data</button>
            </div>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Cari User...">
                <button id="searchButton"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <table class="responsive-table" id="userTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Posisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from database
                include 'koneksi.php'; // File koneksi database Anda
                $query = "SELECT * FROM users";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nama']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['password_hash']}</td>
                                <td>{$row['posisi']}</td>
                                <td>
                                    <button class='btn-edit' onclick='editUser({$row['id']}, \"{$row['username']}\", \"{$row['nama']}\", \"{$row['posisi']}\", \"{$row['password_hash']}\")'><i class='fas fa-edit'></i></button>
                                    <button class='btn-delete' onclick='deleteUser({$row['id']})'><i class='fas fa-trash-alt'></i></button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    <div id="modalForm" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="text-align: center; font-weight: 500;">Tambah/Edit User</h2>
            <form id="userForm" action="saveUser.php" method="post">
                <input type="hidden" id="userId" name="user_id">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" id="posisi" name="posisi" required>
                    </div>
                </div>
                <div class="bottom-toolbar">
                    <button type="reset">Reset</button>
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('modalForm');
            const closeBtn = document.getElementsByClassName('close')[0];
            const addButton = document.getElementById('addButton');
            const printButton = document.getElementById('printButton');
            const userForm = document.getElementById('userForm');
            const userId = document.getElementById('userId');
            const username = document.getElementById('username');
            const nama = document.getElementById('nama');
            const posisi = document.getElementById('posisi');
            const password = document.getElementById('password');
            const searchInput = document.getElementById('searchInput');
            const userTable = document.getElementById('userTable').getElementsByTagName('tbody')[0];

            // Show modal form
            addButton.onclick = function () {
                userForm.reset();
                userId.value = '';
                modal.style.display = 'block';
            }

            // Close modal form
            closeBtn.onclick = function () {
                modal.style.display = 'none';
            }

            // Close modal form when clicking outside of the modal
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }

            // Edit User function
            window.editUser = function (id, usernameValue, namaValue, posisiValue, passwordValue) {
                userId.value = id;
                username.value = usernameValue;
                nama.value = namaValue;
                posisi.value = posisiValue;
                password.value = passwordValue;
                modal.style.display = 'block';
            }

            // Delete User function
            window.deleteUser = function (id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan bisa mengembalikan data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `deleteUser.php?id=${id}`;
                    }
                });
            }

            // Search function
            searchInput.onkeyup = function () {
                const filter = searchInput.value.toLowerCase();
                const rows = userTable.getElementsByTagName('tr');

                Array.from(rows).forEach(row => {
                    const namaCell = row.getElementsByTagName('td')[1];
                    if (namaCell) {
                        const namaText = namaCell.textContent || namaCell.innerText;
                        row.style.display = namaText.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                    }
                });
            }

        });
    </script>
</body>

</html>
