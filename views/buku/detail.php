<?php
$page_title = "Detail Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$book = $id ? getBookById($id) : null;

if (!$book) {
    echo "<div class='text-center mt-10 text-red-500 text-xl'>Buku tidak ditemukan.</div>";
    require_once __DIR__ . '/../../includes/footer.php';
    exit;
}
?>

<div class="max-w-6xl mx-auto mt-12 px-4 md:px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white shadow-xl rounded-2xl p-6">
<div class="flex justify-center items-start">
    <?php
        $image_url = !empty($book['image_path'])
            ? htmlspecialchars($book['image_path'])
            : 'https://via.placeholder.com/200x300?text=No+Cover';
    ?>
    <img src="<?= $image_url; ?>"
         alt="Cover Buku"
         class="rounded-lg shadow-lg w-full max-w-xs transition-transform duration-300 hover:scale-105">
</div>

        <!-- Detail Buku -->
        <div class="space-y-4">
            <h1 class="text-4xl font-extrabold text-gray-800 leading-tight"><?php echo htmlspecialchars($book['judul']); ?></h1>
            <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($book['penulis']); ?> <span class="text-sm text-gray-400">(Penulis)</span></p>
            
            <div class="flex flex-wrap items-center gap-3 mt-2">
                <span class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">
                    <?php echo htmlspecialchars($book['kategori']); ?>
                </span>
            </div>

            <div class="mt-6">
                <table class="w-full text-sm border border-gray-200 rounded-md overflow-hidden">
                    <tbody class="divide-y divide-gray-100">
        
                        <tr>
                            <td class="bg-gray-50 font-medium px-4 py-2 w-40">Penerbit</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($book["penerbit"]); ?></td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-medium px-4 py-2 w-40">Tahun Terbit</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($book["tahun_terbit"]); ?></td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-medium px-4 py-2 w-40">ISBN</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($book["isbn"]); ?></td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-medium px-4 py-2 w-40">Kategori</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($book["kategori"]); ?></td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-medium px-4 py-2 w-40">Deskripsi</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($book["deskripsi"]); ?></td>
                        </tr>
                        <tr>
                            <td class="bg-gray-50 font-medium px-4 py-2 w-40">Stok</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($book["stok"]); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 flex gap-4">
                <div class="mt-6 flex gap-4">
                    <?php if ($book['stok'] > 0): ?>
                        <a href="../peminjaman/add.php?id=<?php echo $book['id']; ?>"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-xl shadow-md transition">
                        Pinjam Buku
                        </a>
                    <?php endif; ?>
                    <?php if ($book['stok'] <= 0): ?>
                        <button disabled class="bg-blue-700 text-white font-semibold px-5 py-2 rounded-xl shadow-md transition disabled:cursor-not-allowed disabled:opacity-60">Stok habis</button>
                    <?php endif; ?>
                <a href="list.php"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-5 py-2 rounded-xl transition">
                    Kembali
                </a>
            </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
