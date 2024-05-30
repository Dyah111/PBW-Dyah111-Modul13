<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);

    // Handle file upload
    $photo = 'default.png';
    if (!empty($_FILES['photo']['name'])) {
        $photo = time() . '_' . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], 'profil/' . $photo);
    }

    $sql = "INSERT INTO users (username, password, fullname, photo) VALUES ('$username', '$password', '$fullname', '$photo')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/log-reg-style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="assets/logo.png" alt="Logo"> 
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="fullname" placeholder="Full Name" class="form-control" required>
            </div>
            <div class="form-group">
                <b>Upload Profil Pict:</b> <input type="file" name="photo">
            </div>
            <button type="submit" class="btn-primary">Register</button>
            <p class="text-muted">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>