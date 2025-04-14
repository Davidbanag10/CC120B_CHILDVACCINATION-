<?php
session_start();
include '../db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM child_profiles WHERE id = $id");
$child = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];

    $conn->query("UPDATE child_profiles SET name='$name', birth_date='$birth_date', gender='$gender' WHERE id = $id");
    header("Location: child_profiles.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Child</title>
<link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<h2>Edit Child Profile</h2>
<form method="POST">
    Name: <input type="text" name="name" value="<?= $child['name'] ?>" required><br>
    Birth Date: <input type="date" name="birth_date" value="<?= $child['birth_date'] ?>" required><br>
    Gender: 
    <select name="gender" required>
        <option value="Male" <?= $child['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $child['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select><br>
    <button type="submit">Update</button>
</form>
<a href="child_profiles.php">← Cancel</a>
</body>
</html>