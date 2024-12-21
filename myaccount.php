<?php
session_start();
require 'db.php'; // Pastikan koneksi database tersedia

// Pastikan pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Ambil informasi pengguna dari sesi
$user_id = $_SESSION['user']['id'];
$user_name = $_SESSION['user']['name'];
$user_email = $_SESSION['user']['email'];

// Proses pembaruan data pengguna
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = trim($_POST['name']);
    $new_email = trim($_POST['email']);
    $new_password = trim($_POST['password']);

    if (!empty($new_name) && !empty($new_email)) {
        // Update nama dan email
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_name, $new_email, $user_id);

        if ($stmt->execute()) {
            // Perbarui sesi pengguna
            $_SESSION['user']['name'] = $new_name;
            $_SESSION['user']['email'] = $new_email;

            $_SESSION['success'] = "Account updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update account.";
        }
        $stmt->close();
    }

    // Update password jika diisi
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Password updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update password.";
        }
        $stmt->close();
    }

    header("Location: myaccount.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <title>My Account - Festify</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/tooplate-artxibition.css" />
</head>
<body>
    <!-- Header -->
    <header class="header-area header-sticky">
        <div class="container">
            <nav class="main-nav">
                <a href="dashboard.php" class="logo">Fest<em>ify</em></a>
                <ul class="nav">
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="tickets.html">Tickets</a></li>
                    <li><a href="myaccount.php" class="active">My Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
                <a class="menu-trigger">
                    <span>Menu</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Account Page Content -->
    <div class="page-heading-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Account</h2>
                    <span>Manage your personal information and account settings.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="account-settings">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- Success/Error Messages -->
                    <?php
                    if (isset($_SESSION['success'])) {
                        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                        unset($_SESSION['success']);
                    }
                    if (isset($_SESSION['error'])) {
                        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                        unset($_SESSION['error']);
                    }
                    ?>

                    <form action="myaccount.php" method="POST" class="form-box">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user_name); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user_email); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                            <span class="toggle-icon" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye" id="toggle-icon"></i>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.className = 'fa fa-eye-slash';
            } else {
                passwordField.type = 'password';
                toggleIcon.className = 'fa fa-eye';
            }
        }
    </script>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="text-center">Copyright &copy; 2024 Festify. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
