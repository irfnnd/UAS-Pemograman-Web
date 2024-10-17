<?php require '../autentikasi/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700");
        @media print {
            .toolbar, #addButton, #printButton, .btn-edit, .btn-delete, .aksi {
                display: none !important;
            }
            .container {
                box-shadow: none !important;
            }
            .container h1 {
                text-align: center;
                margin-bottom: 20px;
                font-size: 24px; /* Set the font size for the heading */
            }
            .container table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px; 
                font-family: "Time New Roman", sans-serif;
                /* Set the font size for the table */
            }
            .container table th, .container table td {
                border: 1px solid black;
                font-family: "Time New Roman", sans-serif;
                padding: 8px;
                text-align: left;
                font-size: 12px; /* Set the font size for the table cells */
            }
            .toolbar .left-buttons {
                display: block !important;
                padding: 10px;
                border-radius: 8px;
                font-family: "Time New Roman", sans-serif;
                font-size: 14px;
                margin-right: 15px;
            }
            /* Ensure filter select remains visible */
            .toolbar #filterSelect {
                display: block !important;
                padding: 10px;
                border-radius: 8px;
                font-family: "Poppins", sans-serif;
                font-size: 14px;
                margin-right: 15px;
            }
        }

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
            padding: 20px;
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

        select#filterSelect {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            margin-right: 15px;
        }

        input#customDate {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            display: none;
            margin-right: 15px;
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
            width: 60%;
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
        input[type="number"],
        input[type="datetime-local"] {
            width: 97%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .bottom-toolbar {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        button[type="submit"],
        button[type="reset"], button#cancelButton {
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
        button#cancelButton {
            background-color: #666;
            color: white;
        }

        button#cancelButton:hover {
            background-color: #3f3f3f;
        }

        .total-amount {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container" id="container">
        <h1>Data Transaksi</h1>
        <div class="toolbar">
            <div class="left-buttons">
                <button id="addButton" class="btn-add">Tambahkan</button>
                <button id="printButton" class="btn-print">Print</button>
                <select id="filterSelect" class="btn-add">
                    <option value="all">Semua Data</option>
                    <option value="today">Hari Ini</option>
                    <option value="this_week">Minggu Ini</option>
                    <option value="this_month">Bulan Ini</option>
                    <option value="custom">Tanggal</option>
                </select>
                <input type="date" id="customDate" style="display: none;">
            </div>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Cari transaksi...">
                <button id="searchButton"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="total-amount" id="totalAmount">Total Transaksi: Rp 0</div>
        <table class="responsive-table" id="transaksiTable">
            <thead>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <th>Keterangan</th>
                    <th>Total Transaksi</th>
                    <th class="aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php'; // Your database connection file
                $query = "SELECT * FROM tabel_transaksi ORDER BY tgl_transaksi DESC;";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["tgl_transaksi"] . "</td>
                                <td>" . $row["keterangan"] . "</td>
                                <td>Rp " . number_format($row["total_transaksi"], 2, ',', '.') . "</td>
                                <td class='aksi'>
                                    <button class='btn-edit' onclick='editData({$row['id']}, \"{$row['tgl_transaksi']}\", \"{$row['keterangan']}\", \"{$row['total_transaksi']}\")'><i class='fas fa-edit'></i></button>
                                    <button class='btn-delete' onclick='deleteData(" . $row["id"] . ")'><i class='fas fa-trash-alt'></i></button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <div id="modalForm" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Tambah/ Edit Data</h1>
            <form id="dataForm" method="POST" action="saveData.php">
                <input type="hidden" id="dataId" name="id">
                <div class="form-group">
                    <label for="tgl_transaksi">Tanggal Transaksi:</label>
                    <input type="datetime-local" id="tgl_transaksi" name="tgl_transaksi" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" id="keterangan" name="keterangan" required>
                </div>
                <div class="form-group">
                    <label for="total_transaksi">Total Transaksi:</label>
                    <input type="number" id="total_transaksi" name="total_transaksi" required>
                </div>
                <div class="bottom-toolbar">
                    <button id="cancelButton" type="button">Batal</button>
                    <button type="reset">Reset</button>
                    <button type="submit">Simpan</button>
                </div>
            </form>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById("modalForm");
            const btn = document.getElementById("addButton");
            const span = document.getElementsByClassName("close")[0];
            const cancelButton = document.getElementById("cancelButton");
            const dataForm = document.getElementById('dataForm');
            const tgl_transaksi = document.getElementById('tgl_transaksi');
            const keterangan = document.getElementById('keterangan');
            const total_transaksi = document.getElementById('total_transaksi');
           

            btn.onclick = function () {
                modal.style.display = "block";
            }

            span.onclick = function () {
                modal.style.display = "none";
            }

            cancelButton.onclick = function () {
                modal.style.display = "none";
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            const filterSelect = document.getElementById('filterSelect');
            const customDateInput = document.getElementById('customDate');

            filterSelect.addEventListener('change', function () {
                if (filterSelect.value === 'custom') {
                    customDateInput.style.display = 'block';
                } else {
                    customDateInput.style.display = 'none';
                    filterTable(filterSelect.value);
                }
            });

            customDateInput.addEventListener('change', function () {
                filterTable(filterSelect.value, customDateInput.value);
            });

            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keyup', function () {
                filterTable(filterSelect.value, customDateInput.value, searchInput.value);
            });

            const totalAmountElement = document.getElementById('totalAmount');

            function filterTable(filterValue, customDate, searchTerm) {
                const rows = document.querySelectorAll('#transaksiTable tbody tr');
                let totalAmount = 0;

                rows.forEach(row => {
                    const dateCell = row.querySelector('td:nth-child(1)').innerText;
                    const descCell = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                    const amountCell = parseFloat(row.querySelector('td:nth-child(3)').innerText.replace('Rp ', '').replace(/\./g, '').replace(',', '.'));
                    const rowDate = new Date(dateCell);
                    const today = new Date();
                    let showRow = true;

                    if (filterValue === 'today') {
                        showRow = rowDate.toDateString() === today.toDateString();
                    } else if (filterValue === 'this_week') {
                        const today = new Date();
                        const startOfWeek = new Date(today);  // Salin tanggal hari ini
                        startOfWeek.setDate(today.getDate() - today.getDay());
                        showRow = rowDate >= startOfWeek && rowDate <= today;

                    } else if (filterValue === 'this_month') {
                        showRow = rowDate.getMonth() === today.getMonth() && rowDate.getFullYear() === today.getFullYear();
                    } else if (filterValue === 'custom') {
                        const customDateValue = new Date(customDate);
                        showRow = rowDate.toDateString() === customDateValue.toDateString();
                    }

                    if (searchTerm) {
                        showRow = showRow && descCell.includes(searchTerm.toLowerCase());
                    }

                    if (showRow) {
                        row.style.display = '';
                        totalAmount += amountCell;
                    } else {
                        row.style.display = 'none';
                    }
                });

                totalAmountElement.innerText = `Total Transaksi: Rp ${totalAmount.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            }

            // Set default filter to today and calculate total transaction
            filterSelect.value = 'today';
            filterTable('today');

            // Handle form submission using AJAX
            
            window.deleteData = function (id) {
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
                        window.location.href = `deleteData.php?id=${id}`;
                    }
                });
            }
            window.editData = function (id, tgl_transaksiValue,keteranganValue, total_transaksiValue) {
                dataId.value = id;
                tgl_transaksi.value = tgl_transaksiValue;
                keterangan.value = keteranganValue;
                total_transaksi.value = total_transaksiValue;
                modal.style.display = 'block';
            }
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('status') && urlParams.get('status') === 'success') {
                const action = urlParams.get('action') === 'updated' ? 'diperbarui' : 'ditambahkan';
                Swal.fire({
                    title: 'Berhasil!',
                    text: `Data berhasil ${action}.`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Remove query parameters from the URL
                    window.history.replaceState({}, document.title, window.location.pathname);
                });
            }

            // Print button
            printButton.onclick = function () {
                const originalContents = document.body.innerHTML;
                const printContents =  document.getElementById('container').outerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        });
    </script>
</body>
</html>
