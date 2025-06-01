<?php
require_once __DIR__ . '/../includes/db_connection.php';
function getTotalMembers() {
    global $conn;
    $sql = "SELECT COUNT(id) as total FROM anggota";
    $result = $conn->query($sql);
    if ($result) {
        return $result->fetch_assoc()['total'];
    }
    return 0;
}

function getTotalBookStock() {
    global $conn;
    $sql = "SELECT SUM(stok) as total_stock FROM buku";
    $result = $conn->query($sql);
    if ($result) {
        return $result->fetch_assoc()['total_stock'] ?? 0;
    }
    return 0;
}

function getTotalBorrowedBooks() {
    global $conn;
    $sql = "SELECT COUNT(id) as total_borrowed FROM transaksi WHERE status = 'dipinjam'";
    $result = $conn->query($sql);
    if ($result) {
        return $result->fetch_assoc()['total_borrowed'];
    }
    return 0;
}
?>