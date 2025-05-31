<?php
$page_title = "Detail Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

$id = $_GET['id'];
$book = getBookById($id);
?>

<h2 class="text-2xl font-bold mb-4">Detail Buku</h2>

<div class="bg-white p-4 rounded shadow-md w-full max-w-lg">
    <p><strong>Judul:</strong> <?php echo htmlspecialchars($book['judul']); ?></p>
    <p><strong>Penulis:</strong> <?php echo htmlspecialchars($book['penulis']); ?></p>
    <p><strong>Penerbit:</strong> <?php echo htmlspecialchars($book['penerbit']); ?></p>
    <p><strong>Tahun Terbit:</strong> <?php echo htmlspecialchars($book['tahun_terbit']); ?></p>
    <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($book['deskripsi']); ?></p>
    <a href="list.php" class="mt-4 inline-block text-blue-600 hover:underline">← Kembali ke daftar</a>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
