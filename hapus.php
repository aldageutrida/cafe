<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

// Validasi ID agar hanya angka yang diterima
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Cek apakah data dengan ID ini ada
    $cek = $conn->query("SELECT * FROM menu WHERE id = $id");
    if ($cek->num_rows > 0) {
        $conn->query("DELETE FROM menu WHERE id = $id");
        // Redirect setelah berhasil dihapus
        header("Location: dashboard.php?pesan=hapus_sukses");
        exit;
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location.href='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid'); window.location.href='dashboard.php';</script>";
}
?>
