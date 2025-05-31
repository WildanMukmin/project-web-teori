<?php
$page_title = "Daftar Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

$books = getBooks();
?>

<h2 class="text-2xl font-bold mb-4">Daftar Buku</h2>
<a href="add.php" class="mb-4 inline-block bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">+ Tambah Buku</a>

<table class="w-full table-auto border-collapse bg-white shadow-md">
    <thead class="bg-gray-200">
        <tr>
            <th class="border px-4 py-2">Judul</th>
            <th class="border px-4 py-2">Penulis</th>
            <th class="border px-4 py-2">Tahun</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book): ?>
            <tr class="text-center">
                <td class="border px-4 py-2"><?php echo htmlspecialchars($book['judul']); ?></td>
                <td class="border px-4 py-2"><?php echo htmlspecialchars($book['penulis']); ?></td>
                <td class="border px-4 py-2"><?php echo $book['tahun_terbit']; ?></td>
                <td class="border px-4 py-2 space-x-2">
                    <a href="detail.php?id=<?php echo $book['id']; ?>" class="text-blue-600">Detail</a>
                    <a href="edit.php?id=<?php echo $book['id']; ?>" class="text-yellow-600">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
