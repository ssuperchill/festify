<?php
session_start();
require 'db.php'; // Panggil file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirm-password"]);

    // Validasi input
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION["error"] = "All fields are required.";
        header("Location: register.html");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Invalid email format.";
        header("Location: register.html");
        exit();
    }

    if ($password !== $confirmPassword) {
        $_SESSION["error"] = "Passwords do not match.";
        header("Location: register.html");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION["success"] = "Registration successful! You can now log in.";
        header("Location: login.php");
    } else {
        $_SESSION["error"] = "Email already exists. Please use another email.";
        header("Location: register.php");
    }

    $stmt->close();
    $conn->close();
}
?>
