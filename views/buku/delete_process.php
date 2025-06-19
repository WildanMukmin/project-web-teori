<?php

include_once '../../functions/buku.php';
require_once '../../includes/gate_auth.php';
$id = $_GET['id'];
if(deleteBook($id)){
    $_SESSION['success'] = "Data buku berhasil dihapus.";
}else{
    $_SESSION['error'] = "Data buku gagal dihapus.";
}
header("Location: list.php");

?>