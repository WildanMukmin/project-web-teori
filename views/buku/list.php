<?php
$page_title = "Daftar Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

$books = getBooks();
?>

<?php if ($role === "user"): ?>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold">Rekomendasi Buku</h1>
        <p class="text-gray-600 mt-1">Temukan inspirasi baca kamu!</p>

        <!-- Kartu Buku -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-6">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <a href="detail.php?id=<?=$book["id"]?>">
                        <div class="relative rounded-lg overflow-hidden shadow-md">
                            <img src="<?= htmlspecialchars($book['gambar'] ?? 'https://images.unsplash.com/photo-1746157802345-8bfd4eff66be?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzfHx8ZW58MHx8fHx8'); ?>" 
                            alt="<?= htmlspecialchars($book['judul']); ?>" 
                            class="h-72 w-full object-cover">
                            <div class="absolute bottom-0 w-full bg-black bg-opacity-60 text-white p-2">
                                <div class="text-sm text-blue-100"><?= htmlspecialchars($book['kategori']); ?></div>
                                <div class="font-semibold truncate"><?= htmlspecialchars($book['judul']); ?></div>
                                <div class="text-sm truncate"><?= htmlspecialchars($book['penulis']); ?></div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500">Belum ada buku tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

<?php elseif ($role === "admin"): ?>
    <!-- Tombol atas -->
    <div class="mb-4 flex items-center space-x-2">
        <a href="../peminjaman/pilih_buku.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Pinjam Buku
        </a>
        <a href="add.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
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
                    <th class="px-4 pygi-2 border">Judul</th>
                    <th class="px-4 py-2 border">Penulis</th>
                    <th class="px-4 py-2 border">Tahun</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr class="text-center hover:bg-gray-50">
                            <td class="px-4 py-2 border"><?= htmlspecialchars($book['judul']); ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($book['penulis']); ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($book['tahun_terbit']); ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($book['kategori']); ?></td>
                            <td class="px-4 py-2 border space-x-1">
                                <a href="detail.php?id=<?= $book['id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-sm">Detail</a>
                                <a href="edit.php?id=<?= $book['id']; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-sm">Edit</a>
                                <a href="delete_process.php?id=<?= $book['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                                <a href="../peminjaman/add.php?id=<?= $book['id']; ?>" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-sm">Pinjam</a>
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
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>