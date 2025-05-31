<?php include_once '../../includes/header.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
  <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-xl">
    <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">📚 Tambah Peminjaman Buku</h2>

    <form action="add_process.php" method="POST" class="space-y-5">
      <div>
        <label class="block font-medium text-gray-700 mb-1">Nama Anggota</label>
        <input type="text" name="nama_anggota" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Judul Buku</label>
        <input type="text" name="judul_buku" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
        <input type="date" name="tanggal_peminjaman" value="<?= date('Y-m-d') ?>" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div class="flex justify-end space-x-3 pt-4">
        <a href="../peminjaman/list.php" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">Batal</a>
        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition">Simpan</button>
      </div>
    </form>
  </div>
</div>

<?php include_once '../../includes/footer.php'; ?>
