<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

include 'connection.php';
$id_user = $_SESSION['id_user'];

$sql = "SELECT fullname FROM users WHERE id_user = $id_user";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$fullname = $row['fullname'];

$sql = "SELECT photo FROM users WHERE id_user = $id_user";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$photo = $row['photo'] ? $row['photo'] : 'default.png';  // Untuk user yang ag upload
?>

<!DOCTYPE html>
<html>
<head>
    <title>RPLACOOL - Timeline</title>
    <link rel="stylesheet" type="text/css" href="assets/bootstrap.css" />
    <style type="text/css">
        body { background-color: #F0F0F0; }
        .box { width: 600px; height: 150px; background-color: white; box-shadow: 0px 0px 2px #95a5a6; margin: 30px auto; padding: 15px; }
        .navbar { width: 100%; padding: 15px; background-color: #fff; box-shadow: 0px 0px 2px #95a5a6; position: fixed; top: 0; z-index: 1000; }
        .navbar img { width: 40px; height: 40px; border-radius: 50%; cursor: pointer; }
		.logo-container { display: flex; align-items: center; }
        .logo img { width: 40px; height: 40px; margin-right: 10px; }
        .app-name { font-weight: bold; font-size: 24px; color: #007bff; }
        .logout { display: none; position: absolute; right: 10px; top: 60px; }
    </style>
    <script type="text/javascript" src="assets/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#profile-pic').click(function() {
                $('#logout').toggle();
            });
        });
    </script>
</head>
<body onload="ambilPost()">
    <div class="navbar">
		<div class="logo-container">
            <div class="logo">
                <img src="assets/logo.png" alt="Logo"> 
            </div>
            <div class="app-name">RPLACOOL</div>
        </div>
        <span>Welcome, <?php echo htmlspecialchars($fullname); ?>!</span>
        <img src="profil/<?php echo $photo; ?>" id="profile-pic" alt="Profile Picture">
        <div id="logout" class="logout">
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
    <div class="container" id="container" style="margin-top: 80px;">
        <div class="box">
            <form id="postForm">
                <textarea id="content" name="content" class="form-control" placeholder="Write Something..." maxlength="255"></textarea>
                <br>
                <button type="button" style="float:right;" class="btn btn-info btn-sm" onclick="buatPost()">POST</button>
            </form>
        </div>
        <div id="post-content"></div>
    </div>
</body>
</html>