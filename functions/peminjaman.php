<?php
require_once __DIR__ . '/../includes/db_connection.php';

function getTransactions() {
    global $conn;

    $sql = "
        SELECT 
            transaksi.id AS transaksi_id,
            anggota.id AS anggota_id,
            anggota.nama AS nama_anggota,
            anggota.email AS email_anggota,
            buku.id AS buku_id,
            buku.judul AS judul_buku,
            buku.penulis AS penulis_buku,
            transaksi.tanggal_peminjaman,
            transaksi.tanggal_pengembalian,
            transaksi.status
        FROM transaksi
        JOIN anggota ON transaksi.id_anggota = anggota.id
        JOIN buku ON transaksi.id_buku = buku.id
        ORDER BY transaksi.tanggal_peminjaman DESC
    ";

    $result = $conn->query($sql);
    return $result;
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

function getTransactionsById($id) {
    global $conn;

    $sql = "
        SELECT 
            transaksi.id AS transaksi_id,
            anggota.id AS anggota_id,
            anggota.nama AS nama_anggota,
            anggota.email AS email_anggota,
            buku.id AS buku_id,
            buku.judul AS judul_buku,
            buku.penulis AS penulis_buku,
            transaksi.tanggal_peminjaman,
            transaksi.tanggal_pengembalian,
            transaksi.status
        FROM transaksi
        JOIN anggota ON transaksi.id_anggota = anggota.id
        JOIN buku ON transaksi.id_buku = buku.id
        WHERE transaksi.id_anggota = $id
        ORDER BY transaksi.tanggal_peminjaman DESC
    ";

    $result = $conn->query($sql);
    return $result;
}

function getTransactionById($id) {
    global $conn;

    $sql = "
        SELECT 
            transaksi.id AS transaksi_id,
            anggota.id AS anggota_id,
            anggota.nama AS nama_anggota,
            buku.id AS buku_id,
            buku.judul AS judul_buku,
            buku.penulis AS penulis_buku,
            transaksi.tanggal_peminjaman,
            transaksi.tanggal_pengembalian,
            transaksi.status
        FROM transaksi
        JOIN anggota ON transaksi.id_anggota = anggota.id
        JOIN buku ON transaksi.id_buku = buku.id
        WHERE transaksi.id = $id
    ";

    $result = $conn->query($sql);
    return $result->fetch_assoc();
}


function deleteTransactionById($id) {
    global $conn;
    $sql = "DELETE FROM transaksi WHERE id = $id";
    return $conn->query($sql);
}

function addTransaction($id_anggota, $id_buku, $tanggal_peminjaman, $tanggal_pengembalian) {
    global $conn;
    $sql = "SELECT stok FROM buku WHERE id = $id_buku";
    $result = $conn->query($sql);
    if($result && $result->fetch_assoc()['stok'] > 0) {
        $sql = "INSERT INTO transaksi (id_anggota, id_buku, tanggal_peminjaman, tanggal_pengembalian) VALUES ($id_anggota, $id_buku, '$tanggal_peminjaman', '$tanggal_pengembalian')";
        $conn->query($sql);
        $sql = "UPDATE buku SET stok = stok - 1 WHERE id = $id_buku";
        $conn->query($sql);
        $_SESSION['success'] = "Peminjaman Berhasil";
        $_SESSION['success_time'] = time();
    }else{
        $_SESSION['error'] = "Stok Buku tidak tersedia";
        $_SESSION['error_time'] = time();
    }
}

function updateTransaction($id, $id_anggota, $id_buku, $tanggal_peminjaman, $tanggal_pengembalian, $status) {
    global $conn;

    $sql_old = "SELECT status FROM transaksi WHERE id = $id";
    $result_old = $conn->query($sql_old);

    if (!$result_old) {
        $_SESSION['error'] = "Gagal mengambil data lama transaksi: " . $conn->error;
        $_SESSION['error_time'] = time();
        return;
    }

    $old_status_data = $result_old->fetch_assoc();
    $old_status = $old_status_data['status'];

    $sql_update = "UPDATE transaksi SET 
        id_anggota = $id_anggota, 
        id_buku = $id_buku, 
        tanggal_peminjaman = '$tanggal_peminjaman', 
        tanggal_pengembalian = '$tanggal_pengembalian', 
        status = '$status' 
        WHERE id = $id";
    $result_update = $conn->query($sql_update);

    if ($result_update) {
        if ($old_status == 'dipinjam' && $status == 'dikembalikan') {
            $conn->query("UPDATE buku SET stok = stok + 1 WHERE id = $id_buku");
        } elseif ($old_status == 'dikembalikan' && $status == 'dipinjam') {
            $conn->query("UPDATE buku SET stok = stok - 1 WHERE id = $id_buku");
        }

        $_SESSION['success'] = "Update Peminjaman Berhasil";
        $_SESSION['success_time'] = time();
    } else {
        $_SESSION['error'] = "Update Peminjaman Gagal: " . $conn->error;
        $_SESSION['error_time'] = time();
    }
}

function getBorrowedBooksByUser($user_id) {
    global $conn;

    $sql = "
        SELECT 
            b.judul AS judul_buku, 
            t.tanggal_pengembalian 
        FROM transaksi t 
        JOIN buku b ON t.id_buku = b.id 
        WHERE t.id_anggota = $user_id AND t.status = 'dipinjam'
        ORDER BY t.tanggal_pengembalian ASC
    ";

    $result = $conn->query($sql);
    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [];
}
?>