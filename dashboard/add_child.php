<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];

    $conn->query("INSERT INTO child_profiles (user_id, name, birth_date, gender) 
                  VALUES ('$user_id', '$name', '$birth_date', '$gender')");
    header("Location: child_profiles.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Child</title>
<link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<h2>Add Child Profile</h2>
<form method="POST">
    Name: <input type="text" name="name" required><br>
    Birth Date: <input type="date" name="birth_date" required><br>
    Gender: 
    <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br>
    <button type="submit">Add</button>
</form>
<a href="child_profiles.php">← Cancel</a>
</body>
</html>
