<?php
session_start(); // Start the session to store user data

include('db.php'); // Make sure your database connection is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare query to check if the email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // bind the email parameter
    $stmt->execute();
    $result = $stmt->get_result(); // get the result from the query
    $user = $result->fetch_assoc(); // fetch user data

    // Check if the user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Successful login, check if the user is an admin
        if ($user['is_admin'] == 1) {
            // Set session variables for admin user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = true; // Mark the session as an admin

            // Redirect to the admin dashboard
            header('Location: dashboard.php');
            exit();
        } else {
            echo "You are not authorized to access the admin dashboard.";
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>
<form method="POST" action="login.php">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

