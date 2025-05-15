<?php
include 'includes/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Hapus komentar (jika ingin hapus juga balasannya, tambahkan OR parent_id = $id)
$conn->query("DELETE FROM comments WHERE id = $id");

header("Location: lainnya.php");
exit();
