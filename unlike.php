<?php 
include 'connection.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];
$id_post = intval($_GET['id']);

if ($id_post > 0) {
    $sql = "DELETE FROM likes WHERE id_user = $id_user AND id_post = $id_post";
    mysqli_query($conn, $sql);
}
?>