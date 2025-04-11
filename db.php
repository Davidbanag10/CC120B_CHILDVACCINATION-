<?php
$host = 'localhost';
$username = 'root'; // Change if needed
$password = '';
$dbname = 'vaccination_system';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>