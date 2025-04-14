<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="dashboard">

        <!-- Top Bar -->
        <header class="topbar">
            <div class="logo">VaxTrack <span class="admin-badge">Admin</span></div>
            <div class="topbar-right">
                <a href="admin_profile.php" class="btn"><i class="fas fa-user-cog"></i> Profile</a>
                <a href="../logout.php" class="btn logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>

        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="admin_users.php" class="sidebar-link"><i class="fas fa-users"></i> Manage Users</a>
            <a href="admin_children.php" class="sidebar-link"><i class="fas fa-child"></i> Child Profiles</a>
            <a href="admin_schedules.php" class="sidebar-link"><i class="fas fa-syringe"></i> Vaccination Schedule</a>
            <a href="admin_reports.php" class="sidebar-link"><i class="fas fa-chart-bar"></i> Reports & Analytics</a>
        </aside>

        <!-- Main Area -->
        <main class="main-content">
            <div class="card">👥 Total Registered Users</div>
            <div class="card">👶 Total Children Profiles</div>
            <div class="card">📅 Vaccination Progress Overview</div>
            <div class="card">📄 Generate Reports</div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            &copy; 2025 VaxTrack Admin Panel | All rights reserved.
        </footer>
    </div>
</body>
</html>
