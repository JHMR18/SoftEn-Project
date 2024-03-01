<?php
// Include the Model
include 'model.php';

if (isset($_POST['studentID']) && isset($_POST['status']) && isset($_POST['date']) && isset($_POST['timestamp'])) {
    $studentID = $_POST['studentID'];
    $newStatus = $_POST['status'];
    $date = $_POST['date'];
    $timestamp = $_POST['timestamp'];

    // Connect to the database
    $conn = connectToDatabase(); 

    if ($newStatus == 'present') {
        // Delete the record if the new status is 'absent'
        $stmt = $conn->prepare("DELETE FROM Scans WHERE studentID = ? AND DATE(scanDate) = ?");
        $stmt->bind_param("ss", $studentID, $date);
    } elseif ($newStatus == 'absent') {
        // Insert a new record if the new status is 'present'
        $stmt = $conn->prepare("INSERT INTO Scans (studentID, scanDate, attendanceStatus) VALUES (?, ?, 'present')");
        $stmt->bind_param("ss", $studentID, date('Y-m-d H:i:s', strtotime($timestamp)));
    } else {
        echo "Invalid status";
        exit();
    }

    if (!$stmt) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    if (!$stmt->execute()) {
        $error = $stmt->error;
        die("Error executing query: $error");
    } else {
        echo "Attendance status updated successfully";
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    echo "Invalid request";
}
?>
