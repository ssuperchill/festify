<?php
session_start();
require 'db.php'; // Koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validasi input
    if (empty($email) || empty($password)) {
        $_SESSION["error"] = "Email and Password are required.";
        header("Location: login.php");
        exit();
    }

    // Ambil data pengguna dari database
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $name, $hashedPassword);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashedPassword)) {
            // Simpan data ke session
            $_SESSION['user'] = [
                'id' => $user_id,
                'name' => $name,
                'email' => $email
            ];

            // Debug session
            echo "<pre>";
            print_r($_SESSION['user']);
            echo "</pre>";

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION["error"] = "Incorrect password.";
            header("Location: login.php");
        }
    } else {
        $_SESSION["error"] = "User not found.";
        header("Location: login.php");
    }

    $stmt->close();
    $conn->close();
}
?>
