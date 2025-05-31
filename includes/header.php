<?php
// includes/header.php
// Pastikan session sudah dimulai jika diperlukan, misal untuk menampilkan nama user
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ambil data user dari session, contoh
$is_logged_in = isset($_SESSION['user']);
$username = $_SESSION['username'] ?? 'Wildan Mukmin';
$role = $_SESSION['role'] ?? 'USER';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Perpustakaan Online'; ?> - Sistem Manajemen Perpustakaan - <?php echo $role ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh; /* Agar footer selalu di bawah */
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1; /* Agar konten utama mengisi ruang yang tersisa */
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">
    <header class="bg-blue-700 text-white shadow-md">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="<?php echo $is_logged_in ? ($role === 'admin' ? 'dashboard_admin.php' : 'dashboard_user.php') : 'index.php'; ?>" class="text-2xl font-bold">
                Perpustakaan Kita <?php echo $username ?>
            </a>
            <div class="flex items-center space-x-6">
                <?php if ($is_logged_in): ?>
                    <?php if ($role === 'admin'): ?>
                        <a href="views/buku/list.php" class="hover:text-blue-200">Buku</a>
                        <a href="views/anggota/list.php" class="hover:text-blue-200">Anggota</a>
                        <a href="views/peminjaman/list.php" class="hover:text-blue-200">Peminjaman</a>
                    <?php else: // role 'user' ?>
                        <a href="views/buku/list.php" class="hover:text-blue-200">Daftar Buku</a>
                        <a href="views/peminjaman/my_history.php" class="hover:text-blue-200">Riwayat Saya</a>
                    <?php endif; ?>
                    <span class="text-blue-200">Halo, <?php echo htmlspecialchars($username); ?>!</span>
                    <a href="../public/auth/logout.php" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md transition duration-300">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="hover:text-blue-200">Login</a>
                    <a href="register.php" class="bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded-md transition duration-300">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">