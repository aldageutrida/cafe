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
    <title>Tambah Menu Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e3cebf;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 360px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #a68477 ;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color:#a68477;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Tambah Menu Baru</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Menu" required>
        <select name="jenis">
            <option value="Makanan">Makanan</option>
            <option value="Minuman">Minuman</option>
        </select>
        <input type="text" name="harga" placeholder=" Harga" required>
        <button type="submit" name="simpan">Simpan Menu</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $harga = (int) str_replace('.', '', $_POST['harga']);

        $sql = "INSERT INTO menu (nama, jenis, harga) VALUES ('$nama', '$jenis', $harga)";
        if ($conn->query($sql)) {
            echo "<p style='color:green; margin-top:15px;'>✅ Menu berhasil ditambahkan.</p>";
            echo "<a class='back-link' href='dashboard.php'>⬅️ Kembali ke Dashboard</a>";
        } else {
            echo "<p style='color:red;'>❌ Gagal menambahkan menu: " . $conn->error . "</p>";
        }
    }
    ?>
</div>

</body>
</html>
