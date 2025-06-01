<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../functions/dashboard.php';

if(!$is_logged_in){
    header("Location: ../public/auth/login.php");
    exit;
}
?>

<?php

$user = $_SESSION['user'];
$admin_name = $user['nama'];

if ($role === "admin") {

    $total_members = getTotalMembers();
    $total_book_stock = getTotalBookStock();
    $total_borrowed_books = getTotalBorrowedBooks();
?>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                <div class="bg-blue-100 p-4 rounded-full"><span class="text-3xl">👥</span></div>
                <div>
                    <p class="text-gray-500 text-sm">Total Anggota</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $total_members; ?></p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                <div class="bg-green-100 p-4 rounded-full"><span class="text-3xl">📚</span></div>
                <div>
                    <p class="text-gray-500 text-sm">Total Stok Buku</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $total_book_stock; ?></p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                <div class="bg-yellow-100 p-4 rounded-full"><span class="text-3xl">🔄</span></div>
                <div>
                    <p class="text-gray-500 text-sm">Buku Sedang Dipinjam</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $total_borrowed_books; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php
}
else if($role === "user"){
?>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang, <?php echo htmlspecialchars($user['nama']); ?>!</h1>
        <p>Gunakan menu di atas untuk menelusuri buku dan melihat riwayat peminjaman Anda.</p>
    </div>
<?php
}
?>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>