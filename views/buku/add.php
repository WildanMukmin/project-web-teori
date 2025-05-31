<?php
$page_title = "Tambah Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addBook($_POST['judul'], $_POST['penulis'], $_POST['tahun']);
    header('Location: list.php');
    exit;
}
?>

<h2 class="text-2xl font-bold mb-4">Tambah Buku Baru</h2>

<form method="POST" class="space-y-4">
    <input type="text" name="judul" placeholder="Judul Buku" class="w-full border p-2 rounded" required>
    <input type="text" name="penulis" placeholder="Penulis" class="w-full border p-2 rounded" required>
    <input type="number" name="tahun" placeholder="Tahun Terbit" class="w-full border p-2 rounded" required>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>


