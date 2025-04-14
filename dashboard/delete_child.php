<?php
session_start();
include '../db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM child_profiles WHERE id = $id");

header("Location: child_profiles.php");
exit();
