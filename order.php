<?php
include 'db.php';

$menu = $conn->query("SELECT * FROM menu");

if (isset($_POST['pesan'])) {
    $nama_pelanggan = $conn->real_escape_string($_POST['nama']);
    $id_menu = (int) $_POST['menu'];
    $jumlah = (int) $_POST['jumlah'];

    $get = $conn->query("SELECT * FROM menu WHERE id = $id_menu")->fetch_assoc();
    $total = $jumlah * $get['harga'];

    $sql = "INSERT INTO pesanan_pelanggan (nama_pelanggan, id_menu, jumlah, total)
            VALUES ('$nama_pelanggan', $id_menu, $jumlah, $total)";
    
    if ($conn->query($sql)) {
        $id_terakhir = $conn->insert_id;
        header("Location: nota.php?id=$id_terakhir"); 
        exit;
    } else {
        echo "Gagal memesan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Makanan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:#e3cebf ;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .order-box {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .order-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background:#a68477;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background:#a68477;
        }
    </style>
</head>
<body>

<div class="order-box">
    <h2>🛒 Form Pemesanan</h2>
    <form method="POST">
        <label for="nama">Nama Anda</label>
        <input type="text" name="nama" id="nama" required>

        <label for="menu">Pilih Menu</label>
        <select name="menu" id="menu" required>
            <?php while ($row = $menu->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>">
                    <?= $row['nama'] ?> - Rp<?= number_format($row['harga'], 0, ',', '.') ?>
                </option>
            <?php } ?>
        </select>

        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" min="1" required>

        <button type="submit" name="pesan">Pesan Sekarang</button>
    </form>
</div>

</body>
</html>
