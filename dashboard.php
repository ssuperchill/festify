<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Ambil nama pengguna dari sesi
$user_name = $_SESSION['user']['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <title>Dashboard - Festify</title>
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

    <!-- Dashboard Content -->
    <div class="page-heading-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2   h2>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
                    <span>Here are your event details and account management options.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="tickets.html"><i class="fa fa-ticket"></i> My Tickets</a></li>
                            <li><a href="myaccount.php"><i class="fa fa-user"></i> Account Settings</a></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="content">
                        <h3>My Tickets</h3>
                        <p>Here you can view and manage your purchased tickets:</p>
                        <div class="ticket-list">
                            <div class="ticket-item">
                                <h4>LaLaLa Festival</h4>
                                <p><i class="fa fa-calendar"></i> 23 - 25 August 2024</p>
                                <p><i class="fa fa-map-marker"></i> Jakarta International Expo, Jakarta</p>
                                <a href="ticket-details-lalalafest.html" class="btn btn-primary">View Details</a>
                            </div>
                            <div class="ticket-item">
                                <h4>Forestra</h4>
                                <p><i class="fa fa-calendar"></i> 31 August 2024</p>
                                <p><i class="fa fa-map-marker"></i> Orchid Forest Cikole, Bandung</p>
                                <a href="ticket-details-forestra.html" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
