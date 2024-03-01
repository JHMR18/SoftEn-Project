<?php
include 'model.php'; // Include the Model

// Function to get names by studentID
function getNamesByStudentID($conn, $studentID) {
    $conn = connectToDatabase();
    $stmt = $conn->prepare("SELECT Students.firstName, Students.middleName, Students.lastName FROM Students WHERE Students.studentID = ?");
    $stmt->bind_param("s", $studentID);
    $stmt->execute();
    $stmt->bind_result($firstName, $middleName, $lastName);

    // Check if a result was found
    if ($stmt->fetch()) {
        $stmt->close();
        return "$firstName $middleName $lastName";
    } else {
        // No result found, handle this case
        $stmt->close();
        return "Unknown";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    $conn = connectToDatabase();
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Perform actions based on the value of $action
        if ($action === 'getNamesByStudentID') {
            if (!isset($_POST['studentID'])) {
                http_response_code(400);
                echo "Error: No studentID provided in the POST request.";
                exit();
            }

            $studentID = $_POST['studentID'];
            echo getNamesByStudentID($conn, $studentID);
            mysqli_close($conn);
        }
    }
}
?>
