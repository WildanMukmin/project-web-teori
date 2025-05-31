<?php
require_once __DIR__ . '/../includes/db_connection.php';

function getBooks() {
    global $conn;
    $sql = "SELECT * FROM buku";
    $result = $conn->query($sql);
    return $result;
}

function getBookById($id) {
    global $conn;
    $sql = "SELECT * FROM buku WHERE id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc(); // langsung return datanya
}

function addBook($judul, $penulis, $penerbit, $tahun_terbit, $isbn, $kategori, $deskripsi, $stok) {
    global $conn;
    $sql = "
        INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, isbn, kategori, deskripsi, stok)
        VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$isbn', '$kategori', '$deskripsi', $stok)
    ";
    $result = $conn->query($sql);
    return $result;
}

function updateBook($id, $judul, $penulis, $penerbit, $tahun_terbit, $isbn, $kategori, $deskripsi, $stok) {
    global $conn;
    $sql = "
        UPDATE buku 
        SET judul = '$judul',
            penulis = '$penulis',
            penerbit = '$penerbit',
            tahun_terbit = '$tahun_terbit',
            isbn = '$isbn',
            kategori = '$kategori',
            deskripsi = '$deskripsi',
            stok = $stok
        WHERE id = $id
    ";
   $result = $conn->query($sql);
    return $result;
}

function deleteBook($id) {
    global $conn;
    $sql = "DELETE FROM buku WHERE id = $id";
    return $conn->query($sql);
}
?>
