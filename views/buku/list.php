<?php
// config.php (kalau dibutuhkan)
$page_title = "Daftar Buku";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $page_title ?> - Sistem Manajemen Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- HEADER -->
<header class="bg-blue-700 text-white shadow-md">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="#" class="text-xl font-bold">OnLibrary</a>
        <ul class="flex space-x-4">
            <li><a href="#" class="hover:underline">Beranda</a></li>
            <li><a href="#" class="hover:underline">Buku</a></li>
            <li><a href="#" class="hover:underline">Anggota</a></li>
        </ul>
    </nav>
</header>

<!-- MAIN -->
<main class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-blue-800 mb-6">Daftar Buku</h2>

    <!-- Rekomendasi Buku -->
    <section class="mb-10">
        <h3 class="text-xl font-semibold mb-1 text-gray-800">Rekomendasi Buku</h3>
        <p class="text-sm text-gray-600 mb-4">Temukan inspirasi baca kamu!</p>

        <div class="flex space-x-4 overflow-x-auto pb-2">
            <?php
            $books = [
                [
                    "judul" => "Bumi",
                    "penulis" => "Tere Liye",
                    "kategori" => "Fiksi",
                    "cover" => "https://cdn.gramedia.com/uploads/items/9786020332956_Bumi-New-Cover.jpg"
                ],
                [
                    "judul" => "Filosofi Teras",
                    "penulis" => "Henry Manampiring",
                    "kategori" => "Non-Fiksi",
                    "cover" => "https://ebooks.gramedia.com/ebook-covers/45496/image_highres/ID_FITE2018MTH12.jpg"
                ],
                [
                    "judul" => "Laut Bercerita",
                    "penulis" => "Leila S. Chudori",
                    "kategori" => "Novel",
                    "cover" => "https://cdn.gramedia.com/uploads/items/9786024246945_Laut-Bercerita.jpg"
                ],
                [
                    "judul" => "Negeri 5 Menara",
                    "penulis" => "Ahmad Fuadi",
                    "kategori" => "Motivasi",
                    "cover" => "https://i.pinimg.com/736x/3c/b0/75/3cb0755d62b2ed7f4144d67c098219b2--book-jacket-portfolio.jpg"
                ],
                [
                    "judul" => "Atomic Habits",
                    "penulis" => "James Clear",
                    "kategori" => "Pengembangan Diri",
                    "cover" => "https://media.shortform.com/covers/png/atomic-habits-cover@8x.png"
                ]
            ];

            foreach (array_slice($books, 0, 5) as $book):
            ?>
                <div class="flex-none w-48 bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                    <?php if ($book['cover']): ?>
                        <img src="<?= htmlspecialchars($book['cover']); ?>" alt="Cover <?= htmlspecialchars($book['judul']); ?>" class="h-64 w-full object-cover" />
                    <?php else: ?>
                        <div class="h-64 bg-gray-200 flex items-center justify-center text-center">
                            <span class="text-gray-500 px-2">Gambar Buku</span>
                        </div>
                    <?php endif; ?>
                    <div class="p-3">
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                            <?= htmlspecialchars($book['kategori']); ?>
                        </span>
                        <h4 class="text-sm font-bold mt-2"><?= htmlspecialchars($book['judul']); ?></h4>
                        <p class="text-xs text-gray-500"><?= htmlspecialchars($book['penulis']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Tabel Daftar Buku -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Judul</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Penulis</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Kategori</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm"><?= htmlspecialchars($book['judul']); ?></td>
                        <td class="px-4 py-2 text-sm"><?= htmlspecialchars($book['penulis']); ?></td>
                        <td class="px-4 py-2 text-sm"><?= htmlspecialchars($book['kategori']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<!-- FOOTER -->
<footer class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white py-8 mt-auto shadow-inner">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <h3 class="text-lg font-semibold mb-3">ABOUT OnLibrary</h3>
                <p class="text-sm leading-relaxed">
                    Sistem Manajemen Perpustakaan yang membantu pengelolaan buku, anggota, dan transaksi secara efektif dan mudah.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3 uppercase">Contact</h3>
                <p class="text-sm">Universitas Lampung, Bandar Lampung</p>
                <p class="text-sm">Email: <a href="mailto:info@onlibrary.com" class="underline hover:text-pink-400">info@onlibrary.com</a></p>
                <p class="text-sm">Telp: <a href="tel:+62895344533797" class="underline hover:text-pink-400">+62 895-344-533-797</a></p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3 uppercase">Our Social Media</h3>
                <div class="flex justify-center md:justify-start space-x-6">
                    <a href="#" class="hover:text-pink-400" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-facebook" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="hover:text-pink-400" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-twitter" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 22.4 1a9 9 0 0 1-2.85 1.1 4.52 4.52 0 0 0-7.73 4.12 12.84 12.84 0 0 1-9.3-4.7 4.48 4.48 0 0 0 1.4 6 4.48 4.48 0 0 1-2.05-.57v.06a4.52 4.52 0 0 0 3.6 4.43 4.52 4.52 0 0 1-2.04.08 4.52 4.52 0 0 0 4.2 3.14 9.06 9.06 0 0 1-5.62 1.94A8.93 8.93 0 0 1 1 19.54 12.75 12.75 0 0 0 7 21c8.4 0 13-7 13-13v-.6A9.18 9.18 0 0 0 23 3z"/></svg>
                    </a>
                    <a href="#" class="hover:text-pink-400" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-instagram" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <p class="mt-8 text-center text-sm text-gray-300">&copy; 2025 OnLibrary. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
