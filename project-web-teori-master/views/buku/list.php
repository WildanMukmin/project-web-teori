<?php
$page_title = "Daftar Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

$books = getBooks();
?>

<!-- Judul & Tombol di Sebelah Kiri -->
<div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-2xl font-bold text-blue-800 mb-2 sm:mb-0">Daftar Buku</h2>
    <a href="add.php" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">
        + Tambah Buku
    </a>
</div>

<!-- Tabel Buku -->
<div class="overflow-x-auto">
    <table class="w-full table-auto border-collapse bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-blue-100 text-blue-900 font-semibold">
            <tr>
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Penulis</th>
                <th class="border px-4 py-2">Tahun</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr class="text-center hover:bg-blue-50 transition">
                    <td class="border px-4 py-2"><?= htmlspecialchars($book['judul']); ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($book['penulis']); ?></td>
                    <td class="border px-4 py-2"><?= $book['tahun_terbit']; ?></td>
                    <td class="border px-4 py-2 space-x-1">
                        <a href="detail.php?id=<?= $book['id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">Detail</a>
                        <a href="edit.php?id=<?= $book['id']; ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edit</a>
                        <a href="delete_process.php?id=<?= $book['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
