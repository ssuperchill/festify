<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require __DIR__ . '/vendor/autoload.php';

// Pastikan Anda sudah menginstal PHPMailer
function kirim_email($email, $isi_email, $judul_email) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Replace with your email
        $mail->Password = 'your-email-password'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'Your App Name');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->isi_email = $isi_email;
        $mail->judul_email = $judul_email;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

?>
