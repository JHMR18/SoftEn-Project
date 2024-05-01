<?php
session_start();
include 'model.php'; // Include the Model
$username = ""; // Initialize the variables
$password = "";
$user_type = "";
$authenticationError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Tlogin"])) {
        $username = $_POST["Tusername"];
        $password = $_POST["Tpassword"];
        $user_type = "teacher";   
    } elseif (isset($_POST["Alogin"])) {
        $username = $_POST["Ausername"];
        $password = $_POST["Apassword"];
        $user_type = "admin";
    }
 
    // Authenticate user using functions from the Model
    $authenticated = authenticateUser($username, $password, $user_type);

    if ($authenticated) {
        // Set the session variable for the username
        $_SESSION['username'] = $username;
  
        if ($user_type === "teacher") {
            $redirect = 'teacher_dashboard.php';
        } elseif ($user_type === "admin") {
            $redirect = 'ADMIN.php';
        }
  
        // Return a JSON response with the redirect URL
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'redirect' => $redirect]);
        exit();
    } else {
        // Authentication failed, return an error message
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Authentication failed']);
        exit();
    }
}
?>