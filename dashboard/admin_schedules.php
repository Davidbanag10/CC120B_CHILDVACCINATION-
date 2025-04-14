<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$schedules = $conn->query("
    SELECT vs.*, cp.name AS child_name 
    FROM vaccination_schedule vs
    JOIN child_profiles cp ON vs.child_id = cp.id
    ORDER BY schedule_date ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vaccination Schedules</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<div class="container">
    <h2>📅 All Vaccination Schedules</h2>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Child</th>
                <th>Vaccine</th>
                <th>Scheduled Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $schedules->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['child_name']) ?></td>
                <td><?= $row['vaccine_name'] ?></td>
                <td><?= $row['schedule_date'] ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin.php" class="back-btn">← Back to Admin Dashboard</a>
</div>
</body>
</html>