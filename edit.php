<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM menu WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e3cebf;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .edit-box {
            background: #ffffff;
            padding: 30px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 400px;
        }

        .edit-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #444;
        }

        input[type="text"], select {
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
            background: #a68477;
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 15px;
        }

        button:hover {
            background: #a68477;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="edit-box">
    <h2>✏️ Edit Menu</h2>
    <form method="POST">
        <label for="nama">Nama Menu</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <label for="jenis">Jenis</label>
        <select name="jenis">
            <option value="Makanan" <?= $data['jenis'] == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
            <option value="Minuman" <?= $data['jenis'] == 'Minuman' ? 'selected' : '' ?>>Minuman</option>
        </select>

        <label for="harga">Harga </label>
        <input type="text" name="harga" value="<?= number_format($data['harga'], 0, '.', '.') ?>" required>

        <button type="submit" name="update"> Simpan Perubahan</button>
    </form>

    <div class="back-link">
        <a href="dashboard.php">← Kembali ke Dashboard</a>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $harga = (int) str_replace('.', '', $_POST['harga']);

        $sql = "UPDATE menu SET nama='$nama', jenis='$jenis', harga=$harga WHERE id=$id";
        if ($conn->query($sql)) {
            echo "<p style='color: green; text-align: center;'>Data berhasil diupdate!</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>Gagal mengupdate data: " . $conn->error . "</p>";
        }
    }
    ?>
</div>

</body>
</html>
