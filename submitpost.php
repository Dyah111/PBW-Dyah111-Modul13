<?php  
include 'connection.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];
$post = trim(mysqli_real_escape_string($conn, $_POST['content']));

if (!empty($post)) {
    $sql = "INSERT INTO posts (id_user, post) VALUES ($id_user, '$post')";
    mysqli_query($conn, $sql);
}
?>