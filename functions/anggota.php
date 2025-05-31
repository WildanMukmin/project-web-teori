<?php
require_once __DIR__ . '/../includes/db_connection.php';

function getMembers(){
    global $conn;
    $sql = "SELECT * FROM anggota";
    $result = $conn->query($sql);
    return $result;
}

function getMember($member_id) {
    global $conn;
    $sql = "SELECT * FROM anggota WHERE id = $member_id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

function addMember($name, $email, $password, $email_password, $email_password_confirm){
    global $conn;
    $sql = "INSERT INTO anggota (name, email, password) VALUES ('$name', '$email', '$password')";
    $result = $conn->query($sql);
    return $result;
}

function updateMember($id, $nama, $alamat, $nomor) {
    global $conn;
    $nama= mysqli_real_escape_string($conn, $nama);
    $alamat= mysqli_real_escape_string($conn, $alamat);
    $nomor= mysqli_real_escape_string($conn, $nomor);
    $id= (int)$id;

    $sql = "UPDATE anggota SET nama = '$nama', alamat = '$alamat', nomor = '$nomor' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

?>