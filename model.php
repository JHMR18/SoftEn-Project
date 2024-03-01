<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Manila');
    
function connectToDatabase() {
    $host = 'localhost';
    $username = 'root'; 
    $password = '';
    $database = 'G3';

    $conn = mysqli_connect($host, $username, $password, $database);
 
    return $conn;
}

function authenticateUser($username, $password, $user_type) {
    $conn = connectToDatabase();

    // Retrieve the hashed password from the database
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ? AND user_type = ?");
    $stmt->bind_param("ss", $username, $user_type);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password_from_db = $row['password'];

        // Verify the password using password_verify()
        if (password_verify($password, $hashed_password_from_db)) {
           // echo "Authentication successful!";
            return true;
        } else {
           // echo "Authentication failed.";
            return false;
        }
    } else {
       // echo "User not found.";
        return false;
    }

    // Close the database connection
    $conn->close();
}
function getStudentAttendance($course, $academic_year, $section, $date) {
    $conn = connectToDatabase();

    // Perform database query to fetch student attendance records based on the selected filters
    $stmt = $conn->prepare("SELECT Students.studentID, Students.firstName, Students.middleName, Students.lastName, Scans.scanDate, IFNULL(Scans.attendanceStatus, 'absent') as attendanceStatus
                           FROM Students
                           LEFT JOIN Scans ON Students.studentID = Scans.studentID AND DATE(Scans.scanDate) = ?
                           WHERE Students.course = ? AND Students.academicYear = ? AND Students.section = ?");

    if (!$stmt) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    $stmt->bind_param("ssss", $date, $course, $academic_year, $section);

    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $result = $stmt->get_result();

    $attendanceRecords = array();

    while ($row = $result->fetch_assoc()) {
        $attendanceRecords[] = $row;
    }

    $stmt->close();
    mysqli_close($conn);

    return $attendanceRecords;
}

function updateAttendanceStatus($studentID, $status, $date, $timestamp) {
    $conn = connectToDatabase();

    // Perform database query to update student attendance status
    $stmt = $conn->prepare("UPDATE Scans SET attendanceStatus = ?, scanDate = ? WHERE studentID = ? AND DATE(scanDate) = ?");
    $stmt->bind_param("ssss", $status, date('Y-m-d H:i:s', strtotime($timestamp)), $studentID, $date);


    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
}

?>
