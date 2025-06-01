<?php
require_once __DIR__ . '/../../includes/gate_auth.php';
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

// Cek apakah ada parameter id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID buku tidak ditemukan.");
}

$id_buku = intval($_GET['id']);
$buku = getBookById($id_buku);
if (!$buku) {
    die("Buku tidak ditemukan.");
}

// Proses jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simpan ke tabel peminjaman
    // Misal fungsi: addPeminjaman($id_buku, $id_user, $tanggal_pinjam);
    header('Location: list.php');
    exit;
}
?>

<h2 class="text-2xl font-bold mb-4">Pinjam Buku</h2>

<p><strong>Judul:</strong> <?= htmlspecialchars($buku['judul']) ?></p>
<p><strong>Penulis:</strong> <?= htmlspecialchars($buku['penulis']) ?></p>

<form method="POST" class="space-y-4 mt-4">
    <label for="tanggal">Tanggal Pinjam</label>
    <input type="date" name="tanggal" class="w-full border p-2 rounded" required>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Pinjam</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
