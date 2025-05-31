<?php
$page_title = "Edit Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

// Validasi id dari parameter GET
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $id = intval($_GET['id']);
    $book = getBookById($id);

    if (!$book) {
        echo "<p class='text-center text-red-600'>Buku dengan ID tersebut tidak ditemukan.</p>";
        require_once __DIR__ . '/../../includes/footer.php';
        exit;
    }
} else {
    echo "<p class='text-center text-red-600'>ID buku tidak valid.</p>";
    require_once __DIR__ . '/../../includes/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi input dari form
    $judul = trim($_POST['judul']);
    $penulis = trim($_POST['penulis']);
    $penerbit = trim($_POST['penerbit']);
    $tahun_terbit = intval($_POST['tahun_terbit']);
    $isbn = trim($_POST['isbn']);
    $kategori = trim($_POST['kategori']);
    $deskripsi = trim($_POST['deskripsi']);
    $stok = intval($_POST['stok']);

    // Jalankan fungsi updateBook yang sudah di-definisikan di buku.php
    $updated = updateBook($id, $judul, $penulis, $penerbit, $tahun_terbit, $isbn, $kategori, $deskripsi, $stok);

    if ($updated) {
        header('Location: list.php');
        exit;
    } else {
        echo "<p class='text-center text-red-600'>Gagal menyimpan perubahan. Silakan coba lagi.</p>";
    }
}
?>

<h2 class="text-2xl font-bold mb-6 text-center text-yellow-700">Edit Buku</h2>

<div class="flex justify-center">
    <form method="POST" class="bg-white shadow-lg rounded-lg px-6 py-6 w-full max-w-2xl space-y-4">
        <input type="text" name="judul" value="<?= htmlspecialchars($book['judul']); ?>" class="w-full border p-2 rounded" required>
        <input type="text" name="penulis" value="<?= htmlspecialchars($book['penulis']); ?>" class="w-full border p-2 rounded" required>
        <input type="text" name="penerbit" value="<?= htmlspecialchars($book['penerbit']); ?>" class="w-full border p-2 rounded" required>
        <input type="number" name="tahun_terbit" value="<?= htmlspecialchars($book['tahun_terbit']); ?>" class="w-full border p-2 rounded" required>
        <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn']); ?>" class="w-full border p-2 rounded" required>
        <input type="text" name="kategori" value="<?= htmlspecialchars($book['kategori']); ?>" class="w-full border p-2 rounded" required>
        <textarea name="deskripsi" class="w-full border p-2 rounded" required><?= htmlspecialchars($book['deskripsi']); ?></textarea>
        <input type="number" name="stok" value="<?= htmlspecialchars($book['stok']); ?>" class="w-full border p-2 rounded" required min="0">

        <div class="flex justify-center">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
