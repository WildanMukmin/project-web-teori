<?php 
include('../../functions/peminjaman.php');

updateTransaction($_POST["id"], $_POST["id_peminjam"], $_POST["id_buku"], $_POST["tanggal_peminjaman"], $_POST["tanggal_pengembalian"], $_POST["status"]);
header("location: list.php");
?>