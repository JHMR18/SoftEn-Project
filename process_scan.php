<?php
include 'model.php'; // Include the Model

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['studentID'])) {
        http_response_code(400);
        echo "Error: No studentID provided in the POST request.";
        exit();
    }

    $studentID = $_POST['studentID'];
    // Perform database operations with the scanned ID (you need to implement this)
    // Example: Insert a new record for the scan
    $result = insertScanRecord($studentID, 'present');
}

function insertScanRecord($studentID, $attendanceStatus) {
    $conn = connectToDatabase();

    // Check if the student ID exists in the database
    $stmtCheckID = $conn->prepare("SELECT COUNT(*) FROM Students WHERE studentID = ?");
    $stmtCheckID->bind_param("s", $studentID);
    $stmtCheckID->execute();
    $stmtCheckID->bind_result($studentCount);
    $stmtCheckID->fetch();
    $stmtCheckID->close();

    if ($studentCount == 0) {
        echo "error";
        mysqli_close($conn);
        return;
    }

    // Check if attendance already exists for today
    $stmtCheckAttendance = $conn->prepare("SELECT COUNT(*) FROM Scans WHERE studentID = ? AND DATE(scanDate) = CURDATE()");
    $stmtCheckAttendance->bind_param("s", $studentID);
    $stmtCheckAttendance->execute();
    $stmtCheckAttendance->bind_result($attendanceCount);
    $stmtCheckAttendance->fetch();
    $stmtCheckAttendance->close();

    if ($attendanceCount > 0) {
        echo "attendance_exists";
    } else {
        // Prepare and execute the SQL statement to insert the record
        $stmt = $conn->prepare("INSERT INTO Scans (studentID, attendanceStatus) VALUES (?, ?)");
        
        // Check if the prepare statement is successful
        if (!$stmt) {
            echo "error: " . $conn->error;
            return;
        }

        $stmt->bind_param("ss", $studentID, $attendanceStatus);

        if ($stmt->execute()) {
            echo "success"; // Echo "success" if the insertion was successful
        } else {
            echo "error: " . $stmt->error; // Echo an error message if the insertion failed
        }

        $stmt->close();
    }

    mysqli_close($conn);
}

// Function to get a scan record for a student on a specific date
function getScanRecord($conn, $studentID, $scanDate) {
    $stmt = $conn->prepare("SELECT * FROM Scans WHERE studentID = ? AND scanDate = ?");
    $stmt->bind_param("ss", $studentID, $scanDate);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>
