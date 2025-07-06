<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$user' AND password='$pass'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $user;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Username atau password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin Cafe</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #e3cebf;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            text-align: center;
        }

        .header-banner {
            width: 350px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .login-box {
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 340px;
            margin: 0 auto;
        }

        .login-box h2 {
            margin-bottom: 25px;
            color: #333;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background: #a68477;
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-box button:hover {
            background: #a68477;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <img src="img/banner.png" alt="Banner Cafe" class="header-banner">
        <div class="login-box">
            <h2>Silahkan Login</h2>
            <form method="POST">
                <input type="text" name="username" placeholder=" Username" required>
                <input type="password" name="password" placeholder=" Password" required>
                <button type="submit" name="login">Masuk</button>
            </form>
        </div>
    </div>

</body>
</html>
