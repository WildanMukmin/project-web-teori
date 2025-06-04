<?php
$page_title = "Tambah Buku";
require_once '../../includes/header.php';
require_once '../../functions/buku.php';
require_once '../../includes/gate_auth.php';

// Proses jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul        = $_POST['judul'];
    $penulis      = $_POST['penulis'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $isbn         = $_POST['isbn'];
    $kategori     = $_POST['kategori'];
    $deskripsi    = $_POST['deskripsi'];
    $stok         = $_POST['stok'];
    $image_path = '';

    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../public/images/buku/';
        $cleanTitle = preg_replace('/[^a-zA-Z0-9-_]/', '_', strtolower($judul));
        $fileName = $isbn . '_' . $cleanTitle . '_' . time() . '.' . pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
        $targetFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $targetFile)) {
            $image_path = '/public/images/buku/' . $fileName;
        }
    }
    $result = addBook($judul, $penulis, $penerbit, $tahun_terbit, $isbn, $kategori, $deskripsi, $stok, $image_path);

    if ($result) {
        header("Location: list.php");
        $_SESSION["success"] = "Buku berhasil ditambahkan.";
        $_SESSION['suscess_time'] = time();
        exit;
    }else{
        $_SESSION["error"] = "Terjadi kesalahan saat menambahkan buku.";
        $_SESSION['error_time'] = time();
    }
}
?>


<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Tambah Buku Baru</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="text" name="judul" placeholder="Judul Buku" class="w-full border p-2 rounded" required>
            <input type="text" name="penulis" placeholder="Penulis" class="w-full border p-2 rounded" required>
            <input type="text" name="penerbit" placeholder="Penerbit" class="w-full border p-2 rounded" required>
            <input type="number" name="tahun_terbit" placeholder="Tahun Terbit" class="w-full border p-2 rounded" required>
            <input type="text" name="isbn" placeholder="ISBN" class="w-full border p-2 rounded" required>
            <input type="text" name="kategori" placeholder="Kategori" class="w-full border p-2 rounded" required>
            <textarea name="deskripsi" placeholder="Deskripsi Buku" class="w-full border p-2 rounded" rows="3" required></textarea>
            <input type="number" name="stok" placeholder="Stok Buku" class="w-full border p-2 rounded" required>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Upload Cover Buku</label>
                <label
                    for="file_upload"
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
                    <input id="file_upload" name="file_upload" type="file" accept="image/*" class="hidden" onchange="previewImage(event)" required>
                </label>
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Pratinjau Gambar:</p>
                    <img id="preview" src="#" alt="Preview" class="w-full max-h-64 object-contain rounded border" />
                </div>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">Simpan</button>
        </form>
    </div>
</div>

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

<?php require_once '../../includes/footer.php'; ?>
