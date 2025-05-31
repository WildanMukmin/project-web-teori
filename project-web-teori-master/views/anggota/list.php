<?php
$page_title = "Daftar Anggota";
// Correct the path to go up one level from 'views/anggota' to the project root
require_once __DIR__ . '/../../includes/header.php'; 
require_once __DIR__ . '/../../functions/anggota.php';

// Security: Only allow admins to access this page
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    // Redirect to a safe page, like the login or dashboard
    header("Location: /project-web-teori/public/auth/login.php");
    exit;
}

$members = getMembers();
?>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Manajemen Anggota</h1>
        <a href="add.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            + Tambah Anggota
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nama</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Email</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Alamat</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Nomor</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($members && $members->num_rows > 0): ?>
                    <?php foreach ($members as $member): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm"><?php echo htmlspecialchars($member['id']); ?></td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm"><?php echo htmlspecialchars($member['nama']); ?></td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm"><?php echo htmlspecialchars($member['email']); ?></td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm"><?php echo htmlspecialchars($member['alamat']); ?></td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm"><?php echo htmlspecialchars($member['nomor']); ?></td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                                <a href="edit.php?id=<?php echo $member['id']; ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                                <a href="delete.php?id=<?php echo $member['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">Belum ada anggota yang terdaftar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Correct the path for the footer as well
require_once __DIR__ . '/../../includes/footer.php'; 
?>