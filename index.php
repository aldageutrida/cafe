<?php
session_start();
include 'db.php';
$menu = $conn->query("SELECT * FROM menu");

// Proses pemesanan langsung dari form
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
        echo "<script>alert('Gagal memesan: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cafe Atmadja</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        header {
            background: url('img/index.png') no-repeat center center;
            background-size: cover;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: brown;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
            font-family: 'Playfair Display', serif;
        }

        header h1 {
            font-size: 36px;
            margin: 0;
        }

        header p {
            font-size: 18px;
        }

        nav {
            text-align: center;
            margin: 30px 0;
        }

        nav button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 8px;
            background: #e3cdbe;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        nav button:hover {
            background: #e3cdbe;
        }

        .content {
            display: none;
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 10px;
            background: #e3cdbe;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            animation: fade 0.5s ease;
        }

        .active {
            display: block;
        }

        @keyframes fade {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button[type="submit"] {
            background: #a68477;
            color: white;
            border: none;
        }

        button[type="submit"]:hover {
            background: #4a8ab5;
        }
    </style>
</head>
<body>

<header>
    <h1>Selamat Datang di Cafe Atmadja</h1>
    <p>Silakan pilih menu di bawah</p>
</header>

<nav>
    <button onclick="showContent('home')">🏠 Dashboard</button>
    <button onclick="showContent('produk')">🍽️ Produk</button>
    <button onclick="showContent('pesan')">🛒 Pesan Makanan</button>
    <button onclick="showContent('login')">🔐 Login Admin</button>
</nav>

<!-- Halaman Dashboard -->
<!-- Halaman Dashboard -->
<div class="content active" id="home">
    <h2>📝 Tentang Kami</h2>
    <p>Cafe Atmadja menyajikan makanan dan minuman terbaik dengan suasana nyaman dan pelayanan ramah.</p>
    <p>Kami percaya bahwa tempat yang nyaman bisa menciptakan semangat baru. Jadi, ayo mampir ke Cafe Atmadja karena di sini, kopi bukan sekadar minuman, tapi teman kerja yang setia.☕✨</p>

    <p><strong>📍 Lokasi:</strong> Jl. Janti No. 7, Bantul, Yogyakarta</p>
    <p><strong>📧 Email:</strong> cafe.atmadja@gmail.com</p>
    <p><strong>📱 WhatsApp:</strong> +62 81-1222 </a></p>
</div>


<!-- Halaman Produk -->
<div class="content" id="produk">
    <h2>🍴 Daftar Menu</h2>
    <table>
        <tr><th>Nama</th><th>Jenis</th><th>Harga</th></tr>
        <?php $menu->data_seek(0); while($row = $menu->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['jenis'] ?></td>
            <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- Halaman Pemesanan -->
<div class="content" id="pesan">
    <h2>🛒 Form Pemesanan</h2>
    <form method="POST">
        <label>Nama Anda:</label>
        <input type="text" name="nama" required>

        <label>Pilih Menu:</label>
        <select name="menu" required>
            <?php $menu->data_seek(0); while ($row = $menu->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>">
                    <?= $row['nama'] ?> - Rp<?= number_format($row['harga'], 0, ',', '.') ?>
                </option>
            <?php } ?>
        </select>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" min="1" required>

        <button type="submit" name="pesan">Pesan Sekarang</button>
    </form>
</div>

<!-- Halaman Login -->
<div class="content" id="login">
    <h2>Login Admin</h2>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
    </form>
</div>
<script>
    function showContent(id) {
        document.querySelectorAll('.content').forEach(el => el.classList.remove('active'));
        document.getElementById(id).classList.add('active');
    }
</script>

</body>
</html>
