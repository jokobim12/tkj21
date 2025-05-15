<?php
session_start();
include 'includes/config.php';

$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
$name = mysqli_real_escape_string($conn, $_POST['name']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

// Simpan nama ke session
$_SESSION['comment_name'] = $name;

$sql = "INSERT INTO comments (parent_id, name, content) VALUES ('$parent_id', '$name', '$content')";
$conn->query($sql);

header("Location: lainnya.php");
exit();
