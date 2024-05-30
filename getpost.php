<?php  
include 'connection.php';

session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];

$sql = "SELECT posts.id_post, posts.post, posts.created_at, users.fullname, users.id_user AS post_owner_id,
    (SELECT COUNT(*) FROM likes WHERE likes.id_post = posts.id_post) AS like_count
    FROM posts
    JOIN users on posts.id_user = users.id_user
    ORDER BY posts.id_post DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $postContent = htmlspecialchars($row['post'], ENT_QUOTES, 'UTF-8');
    $postId = $row['id_post'];
    $fullname = htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8');
    $createdAt = $row['created_at'];
    $likeCount = $row['like_count'];
    $postOwnerId = $row['post_owner_id'];

   // cek apakah current user = pemilik postingan?
    $allowDelete = ($postOwnerId == $id_user);

    echo "
    <div class='box' id='content-container'>
        <div class='row'>
            <div class='col-md-1'></div>
            <div class='col-md-11' style='padding-left:5px;'>
                <p class='text-muted' id='post-text'>$postContent</p>
                <p class='text-muted'>Posted by: $fullname, $createdAt</p>
                <p class='text-muted'>Likes: $likeCount</p>
                <button onclick='likePost($postId)' class='btn btn-primary btn-sm'>Like</button>
                <button onclick='unlikePost($postId)' class='btn btn-secondary btn-sm'>Unlike</button>
                ";

    // Display the delete button only if the current user is the owner of the post
    if ($allowDelete) {
        echo "<button onclick='hapusPost($postId)' class='btn btn-danger btn-sm'>Delete</button>";
    }
    echo "</div></div></div>";
}
?>
