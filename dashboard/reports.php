<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

// Filter
$child_id = $_GET['child_id'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

$child_query = "SELECT * FROM child_profiles WHERE user_id = $user_id";
$children = $conn->query($child_query);

$query = "SELECT * FROM vaccination_records WHERE child_id IN (SELECT id FROM child_profiles WHERE user_id = $user_id)";

if ($child_id) $query .= " AND child_id = $child_id";
if ($date_from) $query .= " AND vaccination_date >= '$date_from'";
if ($date_to) $query .= " AND vaccination_date <= '$date_to'";

$records = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<div class="container">
    <h2>📊 Vaccination Reports</h2>

    <form method="GET" class="filter-form">
        <label>Child:
            <select name="child_id">
                <option value="">All</option>
                <?php while ($c = $children->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>" <?= $c['id'] == $child_id ? 'selected' : '' ?>>
                        <?= $c['name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </label>
        <label>From: <input type="date" name="date_from" value="<?= $date_from ?>"></label>
        <label>To: <input type="date" name="date_to" value="<?= $date_to ?>"></label>
        <button type="submit">Filter</button>
        <a href="export_csv.php?child_id=<?= $child_id ?>&date_from=<?= $date_from ?>&date_to=<?= $date_to ?>" class="btn">⬇ Export CSV</a>
    </form>

    <table class="styled-table">
        <tr>
            <th>Child</th>
            <th>Vaccine</th>
            <th>Date</th>
            <th>Administered By</th>
            <th>Notes</th>
        </tr>
        <?php while ($row = $records->fetch_assoc()):
            $child = $conn->query("SELECT name FROM child_profiles WHERE id = ".$row['child_id'])->fetch_assoc();
        ?>
        <tr>
            <td><?= $child['name'] ?></td>
            <td><?= $row['vaccine_name'] ?></td>
            <td><?= $row['vaccination_date'] ?></td>
            <td><?= $row['administered_by'] ?></td>
            <td><?= $row['notes'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="user.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>