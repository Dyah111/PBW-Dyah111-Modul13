deletePost.php:

<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];
$id_post = intval($_GET['id']);

// Cek apakah user adalah pemilik postingan
$sql_check = "SELECT * FROM posts WHERE id_post = $id_post AND id_user = $id_user";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Hapus likes yang terkait dengan postingan ini
    $sql_delete_likes = "DELETE FROM likes WHERE id_post = $id_post";
    mysqli_query($conn, $sql_delete_likes);

    // Hapus postingan
    $sql_delete_post = "DELETE FROM posts WHERE id_post = $id_post";
    mysqli_query($conn, $sql_delete_post);
}
?>