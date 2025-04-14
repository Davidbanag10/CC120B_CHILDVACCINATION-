<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$message = "";

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    if ($password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET name='$name', password='$hashed' WHERE id=$user_id");
    } else {
        $conn->query("UPDATE users SET name='$name' WHERE id=$user_id");
    }

    $_SESSION['user']['name'] = $name;
    $message = "✅ Profile updated!";
}

// Fetch updated user info
$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <link rel="stylesheet" href="../css/dashboard_styles.css">
</head>
<body>
<div class="container">
    <h2>👤 Your Profile</h2>

    <?php if ($message): ?>
        <p style="color: green; font-weight: bold;"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" class="form-box">
        <label>Name:
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        </label>
        <label>Email:
            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
        </label>
        <label>New Password:
            <input type="password" name="password" placeholder="Leave blank to keep current">
        </label>
        <button type="submit" class="btn">💾 Update Profile</button>
    </form>

    <a href="user.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>