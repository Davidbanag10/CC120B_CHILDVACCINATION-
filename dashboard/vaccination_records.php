<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Vaccination Records</title></head>
<body>
<h2>Vaccination Record Updates</h2>
<!-- Display or update vaccination record data -->
<a href="user.php">← Back to Dashboard</a>
</body>
</html>