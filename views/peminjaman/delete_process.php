<?php

include_once '../../includes/db_connection.php';
include_once '../../functions/peminjaman.php';
$id = $_GET['id'];
deleteTransaction($id);
header("Location: list.php");

?>