<?php
session_start();

// Hapus semua sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Alihkan ke halaman login atau halaman lain yang sesuai
header('Location: login.php'); // Ganti dengan halaman yang sesuai
exit;
?>
