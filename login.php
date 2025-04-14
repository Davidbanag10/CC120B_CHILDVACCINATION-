<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p style="text-align:center;"><a href="signup.php">Create an account</a></p>
</div>
</body>
</html>

<?php
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $res->bind_param("s", $email);
    $res->execute();
    $result = $res->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            if ($user['role'] == 'admin') {
                header("Location: dashboard/admin.php");
            } else {
                header("Location: dashboard/user.php");
            }
        } else {
            echo "<script>alert('Invalid credentials');</script>";
        }
    } else {
        echo "<script>alert('No user found');</script>";
    }
}
?>