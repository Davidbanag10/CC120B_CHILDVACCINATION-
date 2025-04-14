<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

// Fetch all the user's children
$children = $conn->query("SELECT * FROM child_profiles WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head><title>Vaccination Schedule</title>
<link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<h2>Vaccination Schedule</h2>

<?php while ($child = $children->fetch_assoc()): ?>
    <h3>👶 <?= $child['name'] ?> (<?= $child['gender'] ?>)</h3>

    <?php
    $child_id = $child['id'];
    $schedule = $conn->query("SELECT * FROM vaccination_schedule WHERE child_id = $child_id ORDER BY schedule_date ASC");
    ?>

    <table border="1" cellpadding="8">
        <tr>
            <th>Vaccine Name</th>
            <th>Schedule Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($vaccine = $schedule->fetch_assoc()): ?>
        <tr>
            <td><?= $vaccine['vaccine_name'] ?></td>
            <td><?= $vaccine['schedule_date'] ?></td>
            <td><?= $vaccine['status'] ?></td>
            <td>
                <?php if ($vaccine['status'] == 'Pending'): ?>
                    <a href="mark_completed.php?id=<?= $vaccine['id'] ?>" onclick="return confirm('Mark as completed?')">✅ Mark Completed</a>
                <?php else: ?>
                    ✅ Completed
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php endwhile; ?>

<a href="user.php">← Back to Dashboard</a>
</body>
</html>
