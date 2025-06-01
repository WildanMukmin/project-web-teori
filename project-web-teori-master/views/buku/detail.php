<?php
$page_title = "Detail Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

function tampilkanPesanError($pesan) {
    echo "
    <div class='text-center mt-10 text-red-600'>
        <p class='mb-3 font-semibold'>$pesan</p>
        <a href='list.php' class='text-blue-600 hover:underline'>← Kembali ke daftar</a>
    </div>";
    require_once __DIR__ . '/../../includes/footer.php';
    exit;
}

// Validasi ID
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $id = intval($_GET['id']);
    $book = getBookById($id);

    if (!$book) {
        tampilkanPesanError("Buku dengan ID tersebut tidak ditemukan.");
    }
} else {
    tampilkanPesanError("ID buku tidak valid.");
}
?>

<!-- Judul -->
<h2 class="text-2xl font-bold text-blue-800 text-left my-6 max-w-lg mx-auto">Detail Buku</h2>

<!-- Kontainer -->
<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mx-auto text-gray-800 space-y-3">
    <p><strong>Judul:</strong> <?= htmlspecialchars($book['judul']); ?></p>
    <p><strong>Penulis:</strong> <?= htmlspecialchars($book['penulis']); ?></p>
    <p><strong>Penerbit:</strong> <?= htmlspecialchars($book['penerbit']); ?></p>
    <p><strong>Tahun Terbit:</strong> <?= htmlspecialchars($book['tahun_terbit']); ?></p>
    <p><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn']); ?></p>
    <p><strong>Kategori:</strong> <?= htmlspecialchars($book['kategori']); ?></p>
    <p><strong>Stok:</strong> <?= htmlspecialchars($book['stok']); ?></p>
    <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($book['deskripsi'])); ?></p>

    <a href="list.php" class="text-blue-600 hover:underline mt-4 block">← Kembali ke daftar</a>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

