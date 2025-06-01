<?php
$page_title = "Tambah Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';
require_once '../../includes/gate_auth.php';

// Proses jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul       = $_POST['judul'];
    $penulis     = $_POST['penulis'];
    $penerbit    = $_POST['penerbit'];
    $tahun       = $_POST['tahun'];
    $isbn        = $_POST['isbn'];
    $kategori    = $_POST['kategori'];
    $deskripsi   = $_POST['deskripsi'];
    $stok        = $_POST['stok'];

    // Panggil fungsi untuk menyimpan data
    $sukses = addBook($judul, $penulis, $penerbit, $tahun, $isbn, $kategori, $deskripsi, $stok);

    if ($sukses) {
        header('Location: list.php?success=1');
        exit;
    } else {
        echo "<p class='text-red-500 text-center'>Gagal menambahkan buku. Silakan coba lagi.</p>";
    }
}
?>

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Tambah Buku Baru</h2>

        <form method="POST" class="space-y-4">
            <input type="text" name="judul" placeholder="Judul Buku" class="w-full border p-2 rounded" required>
            <input type="text" name="penulis" placeholder="Penulis" class="w-full border p-2 rounded" required>
            <input type="text" name="penerbit" placeholder="Penerbit" class="w-full border p-2 rounded" required>
            <input type="number" name="tahun" placeholder="Tahun Terbit" class="w-full border p-2 rounded" required>
            <input type="text" name="isbn" placeholder="ISBN" class="w-full border p-2 rounded" required>
            <input type="text" name="kategori" placeholder="Kategori" class="w-full border p-2 rounded" required>
            <textarea name="deskripsi" placeholder="Deskripsi Buku" class="w-full border p-2 rounded" rows="3" required></textarea>
            <input type="number" name="stok" placeholder="Stok Buku" class="w-full border p-2 rounded" required>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">Simpan</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
