<?php
$page_title = "Detail Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';

// Validasi ID buku dari parameter GET
$id = isset($_GET['id']) ? $_GET['id'] : null;
$book = $id ? getBookById($id) : null;

?>

<div class="max-w-6xl mx-auto mt-12 px-4 md:px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white shadow-xl rounded-2xl p-6">
        <!-- Cover Buku -->
        <div class="flex justify-center items-start">
            <img src="https://images.unsplash.com/photo-1746157802345-8bfd4eff66be?w=600&auto=format&fit=crop&q=60" alt="Cover Buku"
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
                            <td class="bg-gray-50 font-medium px-4 py-2 w-40">ISBN</td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($book["isbn"]); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
