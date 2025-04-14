<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="vaccination_report.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Child Name', 'Vaccine', 'Date', 'Status']);

    $rows = $conn->query("
        SELECT cp.name AS child_name, vs.vaccine_name, vs.schedule_date, vs.status
        FROM vaccination_schedule vs
        JOIN child_profiles cp ON vs.child_id = cp.id
        ORDER BY cp.name
    ");

    while ($r = $rows->fetch_assoc()) {
        fputcsv($output, $r);
    }

    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<div class="container">
    <h2>📄 Generate Reports</h2>
    <p>Download a CSV report of all children's vaccine schedules.</p>
    <a href="admin_reports.php?download=1" class="btn">⬇️ Download CSV</a>
    <a href="admin.php" class="back-btn">← Back to Admin Dashboard</a>
</div>
</body>
</html>