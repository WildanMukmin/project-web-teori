<?php
$page_title = "Daftar Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

$books = getBooks(); // Ambil data buku dari database
?>

<!-- Tombol atas -->
<div class="mb-4 flex items-center space-x-2">
    <a href="../peminjaman/add.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Pinjam Buku
    </a>
    <!-- Tambah link ID ke add.php -->
    <a href="add.php?id=0" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Tambah Buku
    </a>
</div>

<!-- Judul Halaman -->
<h2 class="text-2xl font-bold text-blue-800 mb-4">Daftar Buku</h2>

<!-- Tabel Daftar Buku -->
<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="w-full table-auto border border-gray-200">
        <thead class="bg-blue-100 text-blue-800">
            <tr>
                <th class="px-4 py-2 border">Judul</th>
                <th class="px-4 py-2 border">Penulis</th>
                <th class="px-4 py-2 border">Tahun</th>
                <th class="px-4 py-2 border">Kategori</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($books)) : ?>
                <?php foreach ($books as $book): ?>
                    <tr class="text-center hover:bg-gray-50">
                        <td class="px-4 py-2 border"><?= htmlspecialchars($book['judul']); ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($book['penulis']); ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($book['tahun_terbit']); ?></td>
                        <td class="px-4 py-2 border"><?= htmlspecialchars($book['kategori']); ?></td>
                        <td class="px-4 py-2 border space-x-1">
                            <a href="detail.php?id=<?= $book['id']; ?>"
                               class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">Detail</a>
                            <a href="edit.php?id=<?= $book['id']; ?>"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-sm">Edit</a>
                            <a href="delete_process.php?id=<?= $book['id']; ?>"
                               class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm"
                               onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data buku.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
