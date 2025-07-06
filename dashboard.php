<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cafe</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e3cebf;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 30px auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .nav {
            margin-bottom: 25px;
        }

        .nav a {
            text-decoration: none;
            margin-right: 15px;
            color: #fff;
            background: #a68477;
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .nav a:hover {
            background:#a68477;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        table th {
            background-color: #a68477;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .aksi a {
            text-decoration: none;
            margin: 0 5px;
            color: #337ab7;
        }

        .aksi a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Selamat datang, <?= htmlspecialchars($_SESSION['admin']) ?> 👋</h2>

    <div class="nav">
        <a href="tambah.php">Tambah Menu</a>
        <a href="riwayat.php">Riwayat Pesanan</a>
        <a href="logout.php">Logout</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $menu = $conn->query("SELECT * FROM menu");
        while ($row = $menu->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['jenis']) ?></td>
            <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td class="aksi">
                <a href="edit.php?id=<?= $row['id'] ?>">✏️ Edit</a>
                <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus menu ini?')">🗑️ Hapus</a>
                <a href="pesan.php?id=<?= $row['id'] ?>">🛒 Pesan</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
