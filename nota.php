<?php
include 'db.php';
date_default_timezone_set('Asia/Jakarta');

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    echo "❌ ID pesanan tidak ditemukan.";
    exit;
}

$id = (int) $_GET['id'];

// Ambil data pesanan
$query = $conn->query("
    SELECT p.*, m.nama AS nama_menu, m.harga 
    FROM pesanan_pelanggan p
    JOIN menu m ON p.id_menu = m.id
    WHERE p.id = $id
");

if (!$query || $query->num_rows === 0) {
    echo "❌ Pesanan tidak ditemukan.";
    exit;
}

$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pesanan</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e3cebf;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            min-height: 100vh;
            margin: 0;
        }

        .nota {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 30px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: left;
        }

        .nota h2 {
            color: #2e7d32;
            margin-bottom: 10px;
        }

        .nota hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .item {
            margin: 8px 0;
            font-size: 15px;
        }

        .nota button, .nota a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .nota button {
            background:#a68477;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .nota button:hover {
            background: #a68477;
        }

        .nota a {
            background: #e0e0e0;
            color: #333;
            margin-left: 10px;
        }

        .nota a:hover {
            background: #d0d0d0;
        }
    </style>
</head>
<body>

<div class="nota">
    <h2>✅ Pesanan Berhasil!</h2>
    <p>Terima kasih telah memesan di Cafe Atmadja.</p>
    <hr>
    <div class="item"><strong>No. Pesanan:</strong> <?= $data['id'] ?></div>
    <div class="item"><strong>Nama Pelanggan:</strong> <?= htmlspecialchars($data['nama_pelanggan']) ?></div>
    <div class="item"><strong>Menu:</strong> <?= $data['nama_menu'] ?></div>
    <div class="item"><strong>Harga Satuan:</strong> Rp<?= number_format($data['harga'], 0, ',', '.') ?></div>
    <div class="item"><strong>Jumlah:</strong> <?= $data['jumlah'] ?></div>
    <div class="item"><strong>Total:</strong> Rp<?= number_format($data['total'], 0, ',', '.') ?></div>
    <div class="item"><strong>Waktu Pesan:</strong> <?= date('d-m-Y H:i:s', strtotime($data['tanggal'])) ?></div>

    <button onclick="window.print()">🖨️ Cetak Nota</button>
    <a href="order.php">← Pesan Lagi</a>
</div>

</body>
</html>
