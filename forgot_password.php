<?php
session_start();
require 'db.php';
require 'mailer.php';

if (isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$err = "";
$sukses = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email)) {
        $err = "Silahkan masukan email";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            $err = "Email: <b>$email</b> tidak ditemukan";
        } else {
            $reset_token = bin2hex(random_bytes(16));
            $reset_link = url_dasar() . "/reset_password.php?email=$email&reset_token=$reset_token";

            $update_sql = "UPDATE users SET reset_token = ? WHERE email = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param('ss', $reset_token, $email);

            if ($update_stmt->execute()) {
                $judul_email = "Reset Password";
                $isi_email = "Klik tautan di bawah untuk mengatur ulang kata sandi Anda:<br><a href='$reset_link'>$reset_link</a><br>Jika Anda tidak meminta pengaturan ulang kata sandi, abaikan email ini.";

                if (kirim_email($email, $judul_email, $isi_email)) {
                    $sukses = "Tautan untuk mengatur ulang kata sandi telah dikirim ke email Anda.";
                } else {
                    $err = "Gagal mengirim email. Silakan coba lagi nanti.";
                }
            } else {
                $err = "Terjadi kesalahan saat memproses permintaan Anda.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lupa Password</h2>
        <p class="text-muted">Masukkan alamat email Anda untuk menerima tautan pengaturan ulang kata sandi.</p>

        <?php if (!empty($err)): ?>
            <div class="alert alert-danger"> <?= $err ?> </div>
        <?php endif; ?>

        <?php if (!empty($sukses)): ?>
            <div class="alert alert-success"> <?= $sukses ?> </div>
        <?php endif; ?>

        <form action="forgot_password.php" method="POST">
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($email) ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim Tautan Reset</button>
        </form>
    </div>
</body>
</html>
