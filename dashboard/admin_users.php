<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$users = $conn->query("SELECT * FROM users WHERE role = 'patient'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<div class="container">
    <h2>👥 All Patients</h2>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered On</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin.php" class="back-btn">← Back to Admin Dashboard</a>
</div>
</body>
</html>