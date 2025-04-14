<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'patient') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$conn->query("UPDATE vaccination_schedule SET status='Completed' WHERE id = $id");

header("Location: vaccination_schedule.php");
exit();
