<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include 'db.php';

// Cek apakah ID menu dikirim
if (!isset($_GET['id'])) {
    echo "ID menu tidak ditemukan. <a href='dashboard.php'>Kembali</a>";
    exit;
}

$id_menu = (int) $_GET['id'];

// Ambil data menu
$query = $conn->query("SELECT * FROM menu WHERE id = $id_menu");
if (!$query || $query->num_rows == 0) {
    echo "Menu tidak ditemukan. <a href='dashboard.php'>Kembali</a>";
    exit;
}
$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Menu - <?= htmlspecialchars($data['nama']) ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background:  #e3cebf;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 35px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 360px;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
            text-align: center;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #a68477;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #a68477;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #555;
            font-size: 13px;
            text-decoration: none;
        }

        .back-link:hover {
            color: #000;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Pesan: <?= htmlspecialchars($data['nama']) ?></h2>

    <form method="POST">
        <input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
        <input type="number" name="jumlah" placeholder="Jumlah Pesanan" min="1" required>
        <button type="submit" name="pesan">Pesan Sekarang</button>
    </form>

    <a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>
</div>

<?php
if (isset($_POST['pesan'])) {
    $nama_pelanggan = $conn->real_escape_string($_POST['nama_pelanggan']);
    $jumlah = (int) $_POST['jumlah'];
    $total = $jumlah * $data['harga'];

    $sql = "INSERT INTO pesanan_pelanggan (nama_pelanggan, id_menu, jumlah, total)
            VALUES ('$nama_pelanggan', $id_menu, $jumlah, $total)";

    if ($conn->query($sql)) {
        $id_terakhir = $conn->insert_id;
        header("Location: nota.php?id=$id_terakhir");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Gagal menyimpan pesanan: " . $conn->error . "</p>";
    }
}
?>

</body>
</html>
