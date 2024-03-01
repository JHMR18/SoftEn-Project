<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="ADMINSTYLE.css">
    <title>Students</title>
    <style>
        #notification {
            position: fixed;
            top: 45vh;
            right: 45vw;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
            display: none;
            z-index: 999;
        }

        #notification.show {
            display: block;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);

        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            text-align: center;
            border-radius: 20px;
        }

        #confirmDelete {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 10px;
            cursor: pointer;
        }

        #cancelDelete {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 10px;
            cursor: pointer;
        }
        .file-input-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-bottom: 20px; /* Adjust as needed */
        }

        .file-input {
            position: absolute;
            font-size: 100px;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .custom-file-input {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db; /* Adjust the color */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-file-input:hover {
            background-color: #2980b9; /* Adjust the hover color */
        }

        .file-name {
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
<div id="notification" class="hidden">
    <p id="notification-message"></p>
</div>
<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-school'></i>
        <span class="text">Onwards to a Smarter Tayabas!</span>
    </a>
    <ul class="side-menu top">
        <li>
            <a href="ADMIN.php">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="active">
            <a href="students.php">
                <i class='bx bxs-graduation' ></i>
                <span class="text">Students</span>
            </a>
        </li>
        <li>
            <a href="teacher.php">
                <i class='bx bxs-book-reader' ></i>
                <span class="text">Teachers</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-notepad' ></i>
                <span class="text">Courses</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#">
                <i class='bx bxs-cog' ></i>
                <span class="text">Settings</span>
            </a>
        </li>
        <li>
            <a id=Alogout href="logout.php" class="logout">
                <i class='bx bxs-log-out-circle' ></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- Add, Delete, and Update Student Forms -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu' ></i>
        <a href="#" class="profile">
            <img src="icons/user.png" alt="">
        </a>
        <a href="#" class="nav-link">Administrator</a>
    </nav>
</section>  
<section id="form">
    <?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    ?>
    <form id="studentForm" method="post" enctype="multipart/form-data">
        <h2 id="add">Add Student</h2>
        <input type="text" name="firstName" placeholder="First Name" require>
        <input type="text" name="middleName" placeholder="Middle Name" require>
        <input type="text" name="lastName" placeholder="Last Name" require>
        <input type="text" name="studentID" placeholder="Student ID" require>
        <input type="text" name="course" placeholder="Course" require>
        <input type="text" name="academicYear" placeholder="Academic Year" require>
        <input type="text" name="section" placeholder="Section" require> <!-- Add section field -->
        <button type="submit" name="addStudent">Add Student</button>

        <h2>Import Students from Excel</h2>
   
        <input type="file" name="excelFile" accept=".xlsx, .xls" class="file-input" id="customFileInput">
        <label for="customFileInput" class="custom-file-input">Choose File</label>
        <span class="file-name" id="fileName"></span>
        <button type="submit" name="importStudents" onclick="return importStudents();">Import Students</button>

    

        <h2>Delete Student</h2>
        <input type="text" name="studentIDToDelete" placeholder="Student ID to Delete">
        <button type="button" id="delete"name="deleteStudent">Delete Student</button>
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <p>Are you sure you want to delete this student?</p>
                <button type="submit" id="confirmDelete" name="deleteStudent">Yes</button>
                <button id="cancelDelete">No</button>
            </div>
        </div>
        <h2>Update Student Information</h2>
        <input type="text" name="studentIDToUpdate" placeholder="Student ID to Update">
        <input type="text" name="updatedFirstName" placeholder="Updated First Name">
        <input type="text" name="updatedMiddleName" placeholder="Updated Middle Name">
        <input type="text" name="updatedLastName" placeholder="Updated Last Name">
        <input type="text" name="updatedCourse" placeholder="Updated Course">
        <input type="text" name="updatedAcademicYear" placeholder="Updated Academic Year">
        <input type="text" name="updatedSection" placeholder="Updated Section"> <!-- Add section field -->
        <button type="submit" name="updateStudent">Update Student</button>
        
    </form>
</section>
<script>
    function showNotification(message, isSuccess) {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');

        notificationMessage.textContent = message;
        if (isSuccess) {
            notification.style.backgroundColor = '#4CAF50'; // Green background for success
        } else {
            notification.style.backgroundColor = '#F44336'; // Red background for error
        }

        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000); // Hide the notification after 3 seconds
    }
    // Show the confirmation dialog
    document.getElementById('delete').addEventListener('click', function () {
        document.getElementById('confirmationModal').style.display = 'block';
    });
    // When "Yes" button is clicked
    document.getElementById('confirmDelete').addEventListener('click', function() {
        // Hide the confirmation dialog
        document.getElementById('confirmationModal').style.display = 'none';

        // Submit the form for deletion
        document.querySelector('form').submit();
    });

    // When "No" button is clicked
    document.getElementById('cancelDelete').addEventListener('click', function() {
        // Hide the confirmation dialog
        document.getElementById('confirmationModal').style.display = 'none';
    });
    function importStudents() {
    // Check if a file is selected
    if (document.getElementById('excelFile').files.length == 0) {
        alert('Please select a file to import.');
        return false;
    }
    return true;
}
document.getElementById('customFileInput').addEventListener('change', function () {
            var fileName = this.value.split('\\').pop();
            document.getElementById('fileName').innerText = fileName;
        });
</script>
<?php
include 'model.php'; // Include the Model

$username = "root"; // Initialize the variables
$password = "";
$user_type = "admin";

// Database connection
$conn = mysqli_connect("localhost", "root", "", "G3");

// Check the connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query to fetch student information from the database
$query = "SELECT firstName, middleName, lastName, studentID, course, academicYear, section FROM Students";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query execution failed: " . mysqli_error($conn));
}

// Add Student Functionality
if (isset($_POST["addStudent"])) {
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $studentID = $_POST["studentID"];
    $course = $_POST["course"];
    $academicYear = $_POST["academicYear"];
    $section = $_POST["section"]; // Add section field

    // Add the student to the database
    $insertQuery = "INSERT INTO Students (firstName, middleName, lastName, studentID, course, academicYear, section) 
                    VALUES ('$firstName', '$middleName', '$lastName', '$studentID', '$course', '$academicYear', '$section')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>showNotification('Student added successfully', true);</script>";
    } else {
        echo "<script>showNotification('Error adding student: " . mysqli_error($conn) . "', false);</script>";
    }
}
//import student functionality
if (isset($_POST["importStudents"])) {
    // Check if a file is uploaded successfully
    if (is_uploaded_file($_FILES['excelFile']['tmp_name'])) {
        $fileInfo = pathinfo($_FILES['excelFile']['name']);

        // Check if the file is an Excel file
        $allowedExtensions = array('xlsx', 'xls');
        if (in_array(strtolower($fileInfo['extension']), $allowedExtensions)) {
            $inputFileName = $_FILES['excelFile']['tmp_name'];

            // Include the PhpSpreadsheet library
            require 'vendor/autoload.php';

            // Create a PhpSpreadsheet object
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

            // Get the active sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Loop through rows and insert data into the database
            foreach ($sheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $data = array();
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }

                // Assuming the order of columns is: Student ID, First Name, Middle Name, Last Name
                $studentID = $data[0];
                $firstName = $data[1];
                $middleName = $data[2];
                $lastName = $data[3];
                $course = $data[4];
                $academicYear = $data[5];
                $section = $data[6];

                // Insert data into the database
                $insertQuery = "INSERT INTO Students (firstName, middleName, lastName, studentID, course, academicYear, section) 
                                VALUES ('$firstName', '$middleName', '$lastName', '$studentID', '$course', '$academicYear', '$section')";

                if (mysqli_query($conn, $insertQuery)) {
                    echo "<script>showNotification('Students imported successfully', true);</script>";
                } else {
                    echo "<script>showNotification('Error importing students: " . mysqli_error($conn) . "', false);</script>";
                }
            }
        } else {
            echo "<script>showNotification('Invalid file format. Please upload a valid Excel file.', false);</script>";
        }
    } else {
        echo "<script>showNotification('Please select a file to import.', false);</script>";
    }
}

// Delete Student Functionality
if (isset($_POST["deleteStudent"])) {
    $studentIDToDelete = $_POST["studentIDToDelete"];

    // Delete the student from the database
    $deleteQuery = "DELETE FROM Students WHERE studentID = '$studentIDToDelete'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>showNotification('Student deleted successfully', true);</script>";
    } else {
        echo "<script>showNotification('Error deleting student: " . mysqli_error($conn) . "', false);</script>";
    }
}

// Update Student Functionality
if (isset($_POST["updateStudent"])) {
    $studentIDToUpdate = $_POST["studentIDToUpdate"];
    $updatedFirstName = $_POST["updatedFirstName"];
    $updatedMiddleName = $_POST["updatedMiddleName"];
    $updatedLastName = $_POST["updatedLastName"];
    $updatedCourse = $_POST["updatedCourse"];
    $updatedAcademicYear = $_POST["updatedAcademicYear"];
    $updatedSection = $_POST["updatedSection"]; // Add section field

    // Update the student's information in the database
    $updateQuery = "UPDATE Students 
                    SET firstName = '$updatedFirstName', middleName = '$updatedMiddleName', lastName = '$updatedLastName', 
                        course = '$updatedCourse', academicYear = '$updatedAcademicYear', section = '$updatedSection' 
                    WHERE studentID = '$studentIDToUpdate'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>showNotification('Student information updated successfully', true);</script>";
    } else {
        echo "<script>showNotification('Error updating student information: " . mysqli_error($conn) . "', false);</script>";
    }
}
?>
</body>
</html>
