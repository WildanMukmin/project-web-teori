<?php

include_once '../../includes/db_connection.php';
include_once '../../functions/peminjaman.php';
require_once '../../includes/gate_admin.php';
$id = $_GET['id'];
if(deleteTransactionById($id)){
    $_SESSION['success'] = "Data peminjaman berhasil dihapus.";
}else{
    $_SESSION['error'] = "Data peminjaman gagal dihapus.";
}
header("Location: list.php");

?>