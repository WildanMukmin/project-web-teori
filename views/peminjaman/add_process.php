<?php 
include('../../functions/peminjaman.php');

addTransaction($_POST["id_peminjam"], $_POST["id_buku"], $_POST["tanggal_peminjaman"], $_POST["tanggal_pengembalian"]);
header("location: list.php");
?>