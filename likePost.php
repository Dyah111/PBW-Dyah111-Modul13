likePost.php:

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
    // Cek apakah user sudah me-like post ini sebelumnya
    $sql_check = "SELECT * FROM likes WHERE id_user = $id_user AND id_post = $id_post";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) == 0) {
        // Jika belum, tambahkan like
        $sql_insert = "INSERT INTO likes (id_user, id_post) VALUES ($id_user, $id_post)";
        mysqli_query($conn, $sql_insert);
    }
    // Jangan menghasilkan output
}
?>