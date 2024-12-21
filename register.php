<?php
session_start();
if (isset($_SESSION["error"])) {
    echo "<div class='alert alert-danger text-center'>" . $_SESSION["error"] . "</div>";
    unset($_SESSION["error"]);
}
if (isset($_SESSION["success"])) {
    echo "<div class='alert alert-success text-center'>" . $_SESSION["success"] . "</div>";
    unset($_SESSION["success"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <title>Register - Festify</title>
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
                    <li><a href="shows-events.html">Show & events</a></li>
                    <li><a href="tickets.html">Tickets</a></li>
                    <li><a href="register.php" class="active">Register</a></li>
                </ul>
                <a class="menu-trigger">
                    <span>Menu</span>
                </a>
            </nav>
        </div>
    </header>

    <!-- Register Form -->
    <div class="page-heading-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Register for Festify</h2>
                    <span>Create an account to access your tickets and manage events.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="register-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="process-register.php" method="POST" class="form-box">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Create a password" required>
                            <span class="toggle-icon" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye" id="toggle-icon"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm your password" required>
                            <span class="toggle-icon" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye" id="toggle-icon"></i>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                        <div class="text-center mt-3">
                            <a href="login.php">Already have an account? Login</a>
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
