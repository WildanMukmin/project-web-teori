<?php

include_once '../../functions/buku.php';
$id = $_GET['id'];
deleteBook($id);
header("Location: list.php");

?>