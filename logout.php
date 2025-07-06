<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout Berhasil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #e3cebf;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logout-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .logout-container h2 {
            color: #333;
            margin-bottom: 15px;
        }

        .logout-container p {
            color: #666;
            margin-bottom: 25px;
        }

        .logout-container a {
            text-decoration: none;
            padding: 12px 25px;
            background-color: #a68477;
            color: #fff;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .logout-container a:hover {
            background-color: #a68477;
        }
    </style>
</head>
<body>

<div class="logout-container">
    <h2>Anda telah berhasil logout</h2>
    <p>Terima kasih telah menggunakan sistem kami.</p>
    <a href="login.php">Kembali ke Login</a>
</div>

</body>
</html>
