<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$children = $conn->query("SELECT * FROM child_profiles WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Child Profiles</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<div class="container">
    <h2>👶 Your Child Profiles</h2>

    <a href="add_child.php" class="btn">➕ Add New Child</a>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birth Date</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $children->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['birth_date'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td>
                    <a href="edit_child.php?id=<?= $row['id'] ?>" class="btn small">✏️ Edit</a>
                    <a href="delete_child.php?id=<?= $row['id'] ?>" class="btn small red" onclick="return confirm('Are you sure?')">🗑 Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="user.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>
