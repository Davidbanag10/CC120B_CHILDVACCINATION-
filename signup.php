<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Signup</title>
</head>
<body>
<div class="container">
    <h2>Signup</h2>
    <form action="signup.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="patient">Patient</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" name="signup">Register</button>
    </form>
    <p style="text-align:center;"><a href="login.php">Already have an account?</a></p>
</div>
</body>
</html>

<?php
if (isset($_POST['signup'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>