<?php
$page_title = "Daftar Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

$books = getBooks();
?>

<?php if ($role === "user"): ?>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold">Rekomendasi Buku</h1>
        <p class="text-gray-600 mt-1">Temukan inspirasi baca kamu!</p>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-6">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <a href="detail.php?id=<?= $book["id"] ?>">
                        <div class="relative rounded-lg overflow-hidden shadow-md">
                            <img src="<?= htmlspecialchars($book['image_path'] ?? 'https://image.gramedia.net/rs:fit:0:0/plain/https://cdn.gramedia.com/uploads/items/img20220905_11324048.jpg'); ?>"
                                alt="<?= htmlspecialchars($book['judul']); ?>" class="h-72 w-full object-cover">
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
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">📚 Kelola Buku</h1>
            <a href="add.php" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow transition duration-200">
                + Tambah Buku
            </a>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
      <?php endif; ?>
      <?php if (isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
          <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
      <?php endif; ?>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-blue-600 text-white uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Judul</th>
                        <th class="px-6 py-3 text-left">Penulis</th>
                        <th class="px-6 py-3 text-left">Tahun</th>
                        <th class="px-6 py-3 text-left">Kategori</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    <?php if (!empty($books)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($books as $book): ?>
                            <tr class="hover:bg-gray-50 border-t">
                                <td class="px-6 py-4"><?= $no++; ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($book['judul']); ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($book['penulis']); ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($book['tahun_terbit']); ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($book['kategori']); ?></td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="detail.php?id=<?= $book['id']; ?>" class="text-blue-600 hover:underline text-sm">📖 Detail</a>
                                    <a href="edit.php?id=<?= $book['id']; ?>" class="text-yellow-600 hover:underline text-sm">✏️ Edit</a>
                                    <a href="delete_process.php?id=<?= $book['id']; ?>" class="text-red-600 hover:underline text-sm" onclick="return confirm('Yakin ingin menghapus buku ini?');">🗑️ Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-500">Belum ada data buku.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
