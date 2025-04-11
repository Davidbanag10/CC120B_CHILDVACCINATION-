<?php
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $birth_date = $_POST["birth_date"];
    $parent_name = $_POST["parent_name"];
    $contact = $_POST["contact"];

    $stmt = $conn->prepare("INSERT INTO children (name, birth_date, parent_name, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $birth_date, $parent_name, $contact);
    
    if ($stmt->execute()) {
        echo "Child added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
<form action="add_child.php" method="POST">
    <input type="text" name="name" placeholder="Child Name" required>
    <input type="date" name="birth_date" required>
    <input type="text" name="parent_name" placeholder="Parent Name" required>
    <input type="text" name="contact" placeholder="Contact Number" required>
    <button type="submit">Add Child</button>
</form>