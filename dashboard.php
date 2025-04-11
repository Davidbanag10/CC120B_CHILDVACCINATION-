<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // If not logged in as admin, redirect to the login page
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .dashboard {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .card {
            background-color: white;
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>Admin Dashboard</h1>
    <a href="logout.php" style="color: white;">Logout</a>
</div>

<div class="dashboard">
    <div class="card">
        <h2>Welcome, Admin!</h2>
        <p>This is your admin dashboard.</p>
        <p>Manage users and other admin functions here.</p>
    </div>

    <!-- Example of a management section -->
    <div class="card">
        <h3>User Management</h3>
        <p>Manage the users who registered on the system.</p>
        <a href="user_management.php">Go to User Management</a>
    </div>
</div>

</body>
</html>
