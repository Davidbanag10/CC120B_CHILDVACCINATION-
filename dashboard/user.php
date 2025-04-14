<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/user_dashboard.css">
</head>
<body>
    <div class="dashboard-container">

        <!-- Top Bar -->
        <header class="topbar">
            <div class="logo">VaxTrack</div>
            <div class="topbar-right">
            <a href="profile.php" class="btn">👤 Profile</a>
                <a href="../logout.php" class="button logout">Logout</a>
            </div>
        </header>

        <!-- Sidebar -->
        <aside class="sidebar">
               <a href="child_profiles.php" class="sidebar-link">Child Profiles</a>
               <a href="vaccination_schedule.php" class="sidebar-link">Vaccination Schedule</a>
               <a href="vaccination_records.php" class="sidebar-link">Vaccination Record Updates</a>
               <a href="reports.php" class="sidebar-link">Reports</a>
        </aside>

       <!-- Main Content -->
        <main class="main-content">
              <a href="child_profiles.php" class="card">👶 Total Registered Children</a>
              <a href="vaccination_schedule.php" class="card">📅 Upcoming Vaccinations</a>
              <a href="vaccination_records.php" class="card">🩺 Recent Vaccination Updates</a>
       </main>


        <!-- Footer -->
        <footer class="footer">
            &copy; 2025 VaxTrack | All rights reserved.
        </footer>
    </div>
</body>
</html>