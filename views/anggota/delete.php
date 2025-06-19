<?php
require_once __DIR__ . '/../../functions/anggota.php';
require_once __DIR__ . '/../../includes/gate_admin.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];

    deleteMember($member_id);

    $_SESSION['success'] = "Data anggota berhasil dihapus.";

    header("Location: list.php?status=deleted");
    exit;
} else {
    $_SESSION['error'] = "Anggota gagal dihapus.";
    header("Location: list.php");
    exit;
}

?>