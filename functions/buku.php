<?php
require_once __DIR__ . '/../includes/db_connection.php';

function getAllBooks() {
    global $conn;
    $query = "SELECT * FROM buku";
    $result = $conn->query($query);
    if (!$result) {
        die("Query Error: " . $conn->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getBookById($id) {
    global $conn;
    $query = "SELECT * FROM buku WHERE id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare Failed: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function addBook($judul, $penulis, $tahun) {
    global $conn;
    $query = "INSERT INTO buku (judul, penulis, tahun_terbit) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare Failed: " . $conn->error);
    }
    $stmt->bind_param("ssi", $judul, $penulis, $tahun);
    return $stmt->execute();
}

function updateBook($id, $judul, $penulis, $tahun) {
    global $conn;
    $query = "UPDATE buku SET judul = ?, penulis = ?, tahun_terbit = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare Failed: " . $conn->error);
    }
    $stmt->bind_param("ssii", $judul, $penulis, $tahun, $id);
    return $stmt->execute();
}
?>
