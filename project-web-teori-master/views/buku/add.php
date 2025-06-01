<?php
$page_title = "Tambah Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $isbn = $_POST['isbn'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    addBook($judul, $penulis, $penerbit, $tahun_terbit, $isbn, $kategori, $deskripsi, $stok);
    header('Location: list.php');
    exit;
}
?>

<h2 class="text-2xl font-bold mb-6 text-blue-800 text-center">Tambah Buku Baru</h2>

<div class="flex justify-center">
    <form method="POST" class="bg-white shadow-lg rounded-lg px-6 py-6 w-full max-w-2xl space-y-4">
        <input type="text" name="judul" placeholder="Judul Buku"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" required>

        <input type="text" name="penulis" placeholder="Penulis"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" required>

        <input type="text" name="penerbit" placeholder="Penerbit"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" required>

        <input type="number" name="tahun_terbit" placeholder="Tahun Terbit"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" required>

        <input type="text" name="isbn" placeholder="ISBN"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" required>

        <input type="text" name="kategori" placeholder="Kategori"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" required>

        <textarea name="deskripsi" placeholder="Deskripsi Buku"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" rows="4" required></textarea>

        <input type="number" name="stok" placeholder="Stok"
            class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-300" required>

        <!-- Tombol di tengah -->
        <div class="flex justify-center">
            <button type="submit"
                class="bg-blue-400 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded shadow transition duration-300">
                Simpan
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
