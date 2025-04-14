<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$child_id = $_GET['child_id'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

$query = "SELECT * FROM vaccination_records WHERE child_id IN (SELECT id FROM child_profiles WHERE user_id = $user_id)";
if ($child_id) $query .= " AND child_id = $child_id";
if ($date_from) $query .= " AND vaccination_date >= '$date_from'";
if ($date_to) $query .= " AND vaccination_date <= '$date_to'";

$result = $conn->query($query);

// Headers for CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=vaccination_report.csv');

$output = fopen("php://output", "w");
fputcsv($output, ['Child', 'Vaccine', 'Date', 'Administered By', 'Notes']);

while ($row = $result->fetch_assoc()) {
    $child = $conn->query("SELECT name FROM child_profiles WHERE id = ".$row['child_id'])->fetch_assoc();
    fputcsv($output, [$child['name'], $row['vaccine_name'], $row['vaccination_date'], $row['administered_by'], $row['notes']]);
}
fclose($output);
exit;