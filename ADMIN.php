<?php
session_start();
include 'model.php'; // Include the Model
$username = "root"; // Initialize the variables
$password = "";
$user_type = "admin";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Alogin"])) {
        $username = $_POST["Ausername"];
        $password = $_POST["Apassword"];
    }

    // Authenticate user using functions from the Model
    $authenticated = authenticateUser($username, $password, $user_type);

    if (!$authenticated) {
        // If authentication fails, you can redirect to a login page or display an error message
        echo "Login failed. Check your credentials.";
        exit();
    }
}
// Check if the logout button is clicked
if(isset($_POST['Alogout'])){
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    // redirect to the index.php page
    header("Location: index.php");
    exit();
}
// Database connection
$conn = mysqli_connect("localhost", "root", "", "G3");

// Check the connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query to fetch student information from the database with separate name columns
$query = "SELECT firstName, middleName, lastName, studentID, course, academicYear, section FROM Students";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query execution failed: " . mysqli_error($conn));
}

// Count the number of students
$countStudentsQuery = "SELECT COUNT(*) as studentCount FROM Students";
$studentsCountResult = mysqli_query($conn, $countStudentsQuery);
$studentsCount = mysqli_fetch_assoc($studentsCountResult);

// Count the number of teachers
$countTeachersQuery = "SELECT COUNT(*) as teacherCount FROM users WHERE user_type = 'teacher'";
$teachersCountResult = mysqli_query($conn, $countTeachersQuery);
$teachersCount = mysqli_fetch_assoc($teachersCountResult);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="ADMINSTYLE.css">
    <title>AdminHub</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-school'></i>
            <span class="text">Onwarsds to a Smarter Tayabas!</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="ADMIN.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
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

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu' ></i>
            <a href="#" class="profile">
                <img src="icons/user.png" alt="">
            </a>
            <a href="#" class="nav-link">Administrator</a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Welcome!</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>

                <a href="QR_scanner.php" target="_blank" class="btn-download">
                    <i class='bx bxs-add-to-queue' ></i>
                    <span class="text">Scanner Module</span>
                </a>
                
            </div>

            <ul class="box-info">
            <li>
                <i class='bx bxs-book-reader'></i>
                <span class="text">
                    <h3><?php echo $teachersCount['teacherCount']; ?></h3>
                    <p>Teachers</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-graduation'></i>
                <span class="text">
                    <h3><?php echo $studentsCount['studentCount']; ?></h3>
                    <p>Students</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-notepad'></i>
                <span class="text">
                    <h3>10</h3>
                    <p>Courses</p>
                </span>
            </li>
            </ul>
            
            <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Enrolled Students</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Course</th>
                            <th>A.Y</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Concatenate first name, middle name, and last name for display
                            $fullName = $row["firstName"] . " " . $row["middleName"] . " " . $row["lastName"];
                            
                            echo "<tr>";
                            echo "<td>" . $fullName . "</td>";
                            echo "<td>" . $row["studentID"] . "</td>";
                            echo "<td>" . $row["course"] . "</td>";
                            echo "<td>" . $row["academicYear"] . "</td>";
                            echo "<td>" . $row["section"] . "</td>"; 
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    

    <script src="script.js"></script>
</body>
</html>
