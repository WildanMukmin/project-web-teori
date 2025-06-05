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
    $image        = $_FILES['file_upload'];
    $result = addBook($judul, $penulis, $penerbit, $tahun_terbit, $isbn, $kategori, $deskripsi, $stok, $image);

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


<div class="flex justify-center items-center min-h-screen bg-gray-100 px-4">
    <div class="w-full max-w-2xl bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">📚 Tambah Buku Baru</h2>

        <form method="POST" enctype="multipart/form-data" class="space-y-5">
            <!-- Judul Buku -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Judul Buku</label>
                <input type="text" name="judul" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Penulis & Penerbit (2 kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Penulis</label>
                    <input type="text" name="penulis" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Penerbit</label>
                    <input type="text" name="penerbit" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Tahun, ISBN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">ISBN</label>
                    <input type="text" name="isbn" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Kategori</label>
                <input type="text" name="kategori" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Deskripsi Buku</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>

            <!-- Stok -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Stok Buku</label>
                <input type="number" name="stok" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Upload Cover -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Upload Cover Buku</label>
                <label
                    for="file_upload"
                    class="flex flex-col items-center justify-center w-full h-52 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition"
                >
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16V4m0 0L3 8m4-4l4 4M21 12v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5m16 0l-4-4m4 4l-4 4"></path>
                        </svg>
                        <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG (maks 2MB)</p>
                    </div>
                    <input id="file_upload" name="file_upload" type="file" accept="image/*" class="hidden" onchange="previewImage(event)" required>
                </label>
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Pratinjau Gambar:</p>
                    <img id="preview" src="#" alt="Preview" class="w-full max-h-64 object-contain rounded border" />
                </div>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow">
                Simpan Buku
            </button>
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
