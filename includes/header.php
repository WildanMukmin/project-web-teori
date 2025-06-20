<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Perpustakaan Online'; ?> - Sistem Manajemen Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="bg-gray-100 text-gray-900 font-inter min-h-full flex flex-col">
    <header class="bg-blue-700 text-white shadow-lg">
        <nav class="container mx-auto px-4 lg:px-6">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="<?= $base_url ?>/public/index.php" class="text-2xl font-bold text-white hover:text-blue-200 transition-colors duration-200">
                    OnLibrary
                </a>

                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-white hover:text-blue-200 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white transition-colors duration-200">
                    <span class="sr-only">Open main menu</span>
                    <i data-lucide="menu" class="h-6 w-6" id="menu-icon"></i>
                    <i data-lucide="x" class="h-6 w-6 hidden" id="close-icon"></i>
                </button>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php if ($is_logged_in): ?>
                        <?php if ($role === 'admin'): ?>
                            <a href="<?= $base_url ?>/views/dashboard.php" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                <i data-lucide="house" class="h-4 w-4"></i>
                                <span class="hidden lg:inline">Dashboard</span>
                            </a>
                            <a href="<?= $base_url ?>/views/anggota/list.php" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                <i data-lucide="users-round" class="h-4 w-4"></i>
                                <span class="hidden lg:inline">Kelola Anggota</span>
                            </a>
                            <a href="<?= $base_url ?>/views/buku/list.php" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                <i data-lucide="book-copy" class="h-4 w-4"></i>
                                <span class="hidden lg:inline">Kelola Buku</span>
                            </a>
                            <a href="<?= $base_url ?>/views/peminjaman/list.php" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                <i data-lucide="hand-helping" class="h-4 w-4"></i>
                                <span class="hidden lg:inline">Kelola Peminjaman</span>
                            </a>
                        <?php elseif ($role === 'user'): ?>
                            <a href="<?= $base_url ?>/views/dashboard.php" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                <i data-lucide="house" class="h-4 w-4"></i>
                                <span class="hidden lg:inline">Dashboard</span>
                            </a>
                            <a href="<?= $base_url ?>/views/buku/list.php" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                <i data-lucide="book-copy" class="h-4 w-4"></i>
                                <span class="hidden lg:inline">Koleksi Buku</span>
                            </a>
                            <a href="<?= $base_url ?>/views/peminjaman/list.php" class="inline-flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                <i data-lucide="hand-helping" class="h-4 w-4"></i>
                                <span class="hidden lg:inline">Riwayat Peminjaman</span>
                            </a>
                        <?php endif; ?>
                        <a href="<?= $base_url ?>/public/auth/logout.php" class="inline-flex items-center space-x-2 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                            <i data-lucide="log-out" class="h-4 w-4"></i>
                            <span class="hidden lg:inline">Logout</span>
                        </a>
                    <?php else: ?>
                        <a href="<?= $base_url ?>/public/auth/login.php" class="bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                            Login
                        </a>
                        <a href="<?= $base_url ?>/public/auth/register.php" class="bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                            Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="md:hidden hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-blue-600">
                    <?php if ($is_logged_in): ?>
                        <?php if ($role === 'admin'): ?>
                            <a href="<?= $base_url ?>/views/dashboard.php" class="flex items-center space-x-3 text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                                <i data-lucide="house" class="h-5 w-5"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="<?= $base_url ?>/views/anggota/list.php" class="flex items-center space-x-3 text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                                <i data-lucide="users-round" class="h-5 w-5"></i>
                                <span>Kelola Anggota</span>
                            </a>
                            <a href="<?= $base_url ?>/views/buku/list.php" class="flex items-center space-x-3 text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                                <i data-lucide="book-copy" class="h-5 w-5"></i>
                                <span>Kelola Buku</span>
                            </a>
                            <a href="<?= $base_url ?>/views/peminjaman/list.php" class="flex items-center space-x-3 text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                                <i data-lucide="hand-helping" class="h-5 w-5"></i>
                                <span>Kelola Peminjaman</span>
                            </a>
                        <?php elseif ($role === 'user'): ?>
                            <a href="<?= $base_url ?>/views/dashboard.php" class="flex items-center space-x-3 text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                                <i data-lucide="house" class="h-5 w-5"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="<?= $base_url ?>/views/buku/list.php" class="flex items-center space-x-3 text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                                <i data-lucide="book-copy" class="h-5 w-5"></i>
                                <span>Koleksi Buku</span>
                            </a>
                            <a href="<?= $base_url ?>/views/peminjaman/list.php" class="flex items-center space-x-3 text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                                <i data-lucide="hand-helping" class="h-5 w-5"></i>
                                <span>Riwayat Peminjaman</span>
                            </a>
                        <?php endif; ?>
                        <div class="border-t border-blue-600 my-2"></div>
                        <a href="<?= $base_url ?>/public/auth/logout.php" class="flex items-center space-x-3 text-red-200 hover:bg-red-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 bg-red-600">
                            <i data-lucide="log-out" class="h-5 w-5"></i>
                            <span>Logout</span>
                        </a>
                    <?php else: ?>
                        <a href="<?= $base_url ?>/public/auth/login.php" class="text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                            Login
                        </a>
                        <a href="<?= $base_url ?>/public/auth/register.php" class="text-white hover:bg-blue-600 hover:text-blue-100 block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200">
                            Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-1 container mx-auto px-4 py-8">