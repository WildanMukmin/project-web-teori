<?php
$page_title = "Edit Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';
require_once '../../includes/gate_admin.php';

$id = $_GET['id'];
$book = getBookById($id);

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     updateBook($id, $_POST['judul'], $_POST['penulis'], $_POST['tahun']);
//     header('Location: list.php');
//     exit;
// }
?>

<h2 class="text-2xl font-bold mb-4">Edit Buku</h2>

<form method="POST" class="space-y-4">
    <input type="text" name="judul" value="<?php echo htmlspecialchars($book['judul']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="penulis" value="<?php echo htmlspecialchars($book['penulis']); ?>" class="w-full border p-2 rounded" required>
    <input type="number" name="tahun" value="<?php echo $book['tahun_terbit']; ?>" class="w-full border p-2 rounded" required>
    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
</form>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
