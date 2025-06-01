<?php
$page_title = "Edit Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

// Sementara comment dulu gate_admin untuk debugging
// require_once '../../includes/gate_admin.php';

// Cek apakah ID tersedia dan valid
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p class='text-red-600'>ID buku tidak ditemukan.</p>";
    require_once __DIR__ . '/../../includes/footer.php';
    exit;
}

$id = (int) $_GET['id'];
$book = getBookById($id);

if (!$book) {
    echo "<p class='text-red-600'>Data buku tidak ditemukan di database.</p>";
    require_once __DIR__ . '/../../includes/footer.php';
    exit;
}

// Proses update jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = $_POST['judul'];
    $penulis   = $_POST['penulis'];
    $penerbit  = $_POST['penerbit'];
    $tahun     = $_POST['tahun'];
    $isbn      = $_POST['isbn'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $stok      = $_POST['stok'];

    $berhasil = updateBook($id, $judul, $penulis, $penerbit, $tahun, $isbn, $kategori, $deskripsi, $stok);

    if ($berhasil) {
        // Setelah update berhasil, redirect ke list buku dengan pesan sukses
        header("Location: list.php?update=1");
        exit;
    } else {
        echo "<p class='text-red-600'>Gagal mengupdate buku.</p>";
    }
}
?>

<h2 class="text-2xl font-bold mb-4">Edit Buku</h2>

<form method="POST" class="space-y-4">
    <input type="text" name="judul" value="<?= htmlspecialchars($book['judul']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="penulis" value="<?= htmlspecialchars($book['penulis']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="penerbit" value="<?= htmlspecialchars($book['penerbit']); ?>" class="w-full border p-2 rounded" required>
    <input type="number" name="tahun" value="<?= htmlspecialchars($book['tahun_terbit']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="kategori" value="<?= htmlspecialchars($book['kategori']); ?>" class="w-full border p-2 rounded" required>
    <textarea name="deskripsi" class="w-full border p-2 rounded" rows="3" required><?= htmlspecialchars($book['deskripsi']); ?></textarea>
    <input type="number" name="stok" value="<?= htmlspecialchars($book['stok']); ?>" class="w-full border p-2 rounded" required>
    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
