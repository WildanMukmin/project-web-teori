<?php
$page_title = "Edit Buku";
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../functions/buku.php';
// require_once '../../includes/gate_admin.php'; // Aktifkan kembali jika diperlukan

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

    // Cek apakah ada file cover yang diunggah
    $coverPath = $book['cover']; // Default pakai yang lama
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../uploads/';
        $fileName  = time() . '_' . basename($_FILES['cover']['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
            $coverPath = 'uploads/' . $fileName;
        }
    }

    $berhasil = updateBook($id, $judul, $penulis, $penerbit, $tahun, $isbn, $kategori, $deskripsi, $stok, $coverPath);

    if ($berhasil) {
        header("Location: list.php?update=1");
        exit;
    } else {
        echo "<p class='text-red-600'>Gagal mengupdate buku.</p>";
    }
}
?>

<h2 class="text-2xl font-bold mb-4">Edit Buku</h2>

<form method="POST" enctype="multipart/form-data" class="space-y-4">
    <input type="text" name="judul" value="<?= htmlspecialchars($book['judul']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="penulis" value="<?= htmlspecialchars($book['penulis']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="penerbit" value="<?= htmlspecialchars($book['penerbit']); ?>" class="w-full border p-2 rounded" required>
    <input type="number" name="tahun" value="<?= htmlspecialchars($book['tahun_terbit']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn']); ?>" class="w-full border p-2 rounded" required>
    <input type="text" name="kategori" value="<?= htmlspecialchars($book['kategori']); ?>" class="w-full border p-2 rounded" required>
    <textarea name="deskripsi" class="w-full border p-2 rounded" rows="3" required><?= htmlspecialchars($book['deskripsi']); ?></textarea>
    <input type="number" name="stok" value="<?= htmlspecialchars($book['stok']); ?>" class="w-full border p-2 rounded" required>

    <!-- Upload Cover -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Upload Cover Buku</label>
        <label
            for="cover"
            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition"
        >
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg
                    class="w-10 h-10 mb-3 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 16V4m0 0L3 8m4-4l4 4M21 12v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5m16 0l-4-4m4 4l-4 4"
                    ></path>
                </svg>
                <p class="mb-2 text-sm text-gray-500">
                    <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                </p>
                <p class="text-xs text-gray-500">PNG, JPG, JPEG (maks 2MB)</p>
            </div>
            <input id="cover" name="cover" type="file" accept="image/*" class="hidden" onchange="previewImage(event)">
        </label>
        <div id="imagePreview" class="mt-4 <?php echo !empty($book['cover']) ? '' : 'hidden'; ?>">
    <p class="text-sm text-gray-600 mb-2">Pratinjau Gambar:</p>
    <img
        id="preview"
        src="<?php echo !empty($book['cover']) ? '../../' . htmlspecialchars($book['cover']) : '#'; ?>"
        alt="Preview"
        class="w-full max-h-64 object-contain rounded border"
    />
</div>


    </div>

    <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
</form>

<!-- Script preview gambar -->
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
