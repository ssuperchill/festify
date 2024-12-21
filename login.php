<?php
session_start();
if (isset($_SESSION["error"])) {
    echo "<div class='alert alert-danger text-center'>" . $_SESSION["error"] . "</div>";
    unset($_SESSION["error"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <title>Login - Festify</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/tooplate-artxibition.css" />
</head>
<body>
    <!-- Header -->
    <header class="header-area header-sticky">
        <div class="container">
            <nav class="main-nav">
                <a href="index.html" class="logo">Fest<em>ify</em></a>
                <ul class="nav">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="shows-events.html">Shows & Events</a></li>
                    <li><a href="tickets.html">Tickets</a></li>
                    <li><a href="login.php" class="active">Login</a></li>
                </ul>
                <a class="menu-trigger">
                    <span>Menu</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Login Form -->
    <div class="page-heading-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Login to Festify</h2>
                    <span>Access your account and manage tickets.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="process-login.php" method="POST" class="form-box">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group password-toogle">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            <span class="toggle-icon" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye" id="toggle-icon"></i>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <div class="text-center mt-3">
                            <a href="register.php">Don't have an account? Register</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="forgot_password.php">Forgot Password?</a>
                        </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="copyright text-center">Copyright &copy; 2024 Festify. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
