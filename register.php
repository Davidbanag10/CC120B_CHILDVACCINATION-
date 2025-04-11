<?php
session_start(); // Start the session to store user data

include('db.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare query to insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (email, password, is_admin) VALUES (?, ?, ?)");
    $is_admin = 0; // Default user type as non-admin, change if needed
    $stmt->bind_param("ssi", $email, $hashedPassword, $is_admin);

    // Execute the query
    if ($stmt->execute()) {
        echo "User registered successfully!";
        // Optionally, redirect to login page after registration
        header('Location: login.html');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<form method="POST" action="register.php">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
