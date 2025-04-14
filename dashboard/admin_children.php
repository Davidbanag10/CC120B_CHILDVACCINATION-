<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$children = $conn->query("
    SELECT child_profiles.*, users.name AS parent_name 
    FROM child_profiles 
    JOIN users ON child_profiles.user_id = users.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Child Profiles</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<div class="container">
    <h2>🧒 All Child Profiles</h2>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Child Name</th>
                <th>Birth Date</th>
                <th>Gender</th>
                <th>Parent</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $children->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['birth_date'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= htmlspecialchars($row['parent_name']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin.php" class="back-btn">← Back to Admin Dashboard</a>
</div>
</body>
</html>