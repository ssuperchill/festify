<?php
session_start();

require 'db.php';

if (isset($_SESSION['user_email']) != '') {
    header("Location: login.php");
    exit();
}

$err = "";
$sukses = "";

$email = isset($_GET['email']) ? $_GET['email'] : '';
$reset_token = isset($_GET['reset_token']) ? $_GET['reset_token'] : '';

if ($reset_token == '' or $email == '') {
    $err .= "Invalid link or email not found.";
} else {
    $sql1 = "SELECT * FROM users WHERE email = '$email' AND reset_token = '$reset_token'";
    $q1 = mysqli_query($conn, $sql1);
    $n1 = mysqli_num_rows($q1);

    if ($n1 < 1) {
        $err .= "Invalid email or token. Please try again.";
    }
}

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if ($password == '' or $konfirmasi_password == '') {
        $err .= "Please enter your password.";
    } elseif ($konfirmasi_password != $password) {
        $err .= "Password confirmation does not match.";
    } elseif (strlen($password) < 6) {
        $err .= "Password must be at least 6 characters.";
    }

    if (empty($err)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql1 = "UPDATE users SET reset_token = '', password = '$hashed_password' WHERE email = '$email'";
        mysqli_query($koneksi, $sql1);
        $sukses = "Password successfully changed. Please <a href='" . url_dasar() . "/login.php'>Login</a>.";
    }
}
?>
<?php if ($err) echo "<div class='error'>$err</div>"; ?>
<?php if ($sukses) echo "<div class='success'>$sukses</div>"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Reset Password</h2>
        <p class="text-muted">Enter your new password below.</p>

        <form action="reset_password.php?email=<?php echo $email; ?>&reset_token=<?php echo $reset_token; ?>" method="POST">
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="konfirmasi_password">Confirm Password</label>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
    </div>
</body>
</html>
