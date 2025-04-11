<?php
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $child_id = $_POST["child_id"];
    $vaccine_id = $_POST["vaccine_id"];
    $appointment_date = $_POST["appointment_date"];

    $stmt = $conn->prepare("INSERT INTO appointments (child_id, vaccine_id, appointment_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $child_id, $vaccine_id, $appointment_date);
    
    if ($stmt->execute()) {
        echo "Appointment scheduled successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
<form action="schedule_appointment.php" method="POST">
    <input type="number" name="child_id" placeholder="Child ID" required>
    <input type="number" name="vaccine_id" placeholder="Vaccine ID" required>
    <input type="date" name="appointment_date" required>
    <button type="submit">Schedule Appointment</button>
</form>