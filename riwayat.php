<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan Pelanggan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:#e3cebf;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .back-link {
            display: block;
            margin: 20px auto;
            text-align: center;
            font-size: 16px;
            color: #333;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        table {
            width: 95%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color:#a68477 ;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #333;
        }
    </style>
</head>
<body>

    <h2>📋 Riwayat Pesanan Pelanggan</h2>
    <a href="dashboard.php" class="back-link">⬅️Kembali ke Dashboard</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Nama Menu</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>

        <?php
        $no = 1;
        $query = $conn->query("
            SELECT p.*, m.nama AS nama_menu 
            FROM pesanan_pelanggan p
            JOIN menu m ON p.id_menu = m.id
            ORDER BY p.tanggal DESC
        ");

        while ($row = $query->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
            <td><?= $row['nama_menu'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
            <td><?= $row['tanggal'] ?></td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
