<?php
session_start();
include 'model.php'; // Include the Model

$username = "";
$password = "";
$user_type = "teacher";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Tlogin"])) {
        $username = $_POST["Tusername"];
        $password = $_POST["Tpassword"];
    }

    // Authenticate user using functions from the Model
    $authenticated = authenticateUser($username, $password, $user_type);

    if (!$authenticated) {
        // If authentication fails, you can redirect to a login page or display an error message
        echo "Login failed. Check your credentials.";
        exit();
    } else {
        // Set the session variable for the username
        $_SESSION['username'] = $username;
    }
}
$username = $_SESSION['username'];
// Check if the logout button is clicked
if(isset($_POST['Tlogout'])){
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="Teacher_dashboard.css">
    <title>Teacher's Dashboard</title>
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
                <a href="Teacher_dashboard.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="teacher_account.php">
                    <i class='bx bxs-book-reader' ></i>
                    <span class="text">Update Account</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-notepad' ></i>
                    <span class="text">Courses(Not available)</span>
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
                <a id=Tlogout href="logout.php" class="logout">
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
            <a href="#" class="nav-link"><h1><?php echo $username ?></h1></a>
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
                <div class="filter">
                <div class="course">
                <label for="course">Course:</label>
                <select name="course" id="course">
                    <!-- Populate with course options from database -->
                    <option value="BSCS">BSCS</option>
                    <option value="BSTM">BSTM</option>
                    <option value="BCAED">BCAEd</option>
                    <option value="BSENTREP">BSEntrep</option>
                    <!-- Add more options as needed -->
                </select>
                </div>

                <div class="ay">
                <label for="academic_year">Academic Year:</label>
                <select name="academic_year" id="academic_year">
                    <!-- Populate with academic year options from database -->
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <!-- Add more options as needed -->
                </select>
                </div>

                <div class="section">
                <label for="section">Section:</label>
                <select name="section" id="section">
                    <!-- Populate with section options from database -->
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <!-- Add more options as needed -->
                </select>
                </div>

                <di class="date">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : date('Y-m-d'); ?>" required>
                </di>
                <button type="button" id="filter">Fetch Record</button>
            </div>
                
            </div>
            <ul class="box-info">
                <li>
                    <i class='bx bxs-check-circle'></i>
                    <span class="text">
                        <h3 id="presentCount">0</h3>
                        <p>Present Students</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-x-circle'></i>
                    <span class="text">
                        <h3 id="absentCount">0</h3>
                        <p>Absent Students</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-notepad'></i>
                    <span class="text">
                        <h3 id="totalCount">0</h3>
                        <p>Total Students</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Attendance Record</h3>
                    <i class='bx bx-search'></i>
                    <i class='bx bx-filter'></i>
                </div>

                <div id="attendance-tables"></div>
            </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    
    <script>
document.getElementById('filter').addEventListener('click', function () {
    fetchAttendance();
});

function fetchAttendance() {
    // Fetch student attendance records using AJAX
    var course = document.getElementById('course').value;
    var academic_year = document.getElementById('academic_year').value;
    var section = document.getElementById('section').value;
    var date = document.getElementById('date').value;

    // Get the current date in the format of the input date field
    var currentDate = new Date().toISOString().slice(0, 10);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('attendance-tables').innerHTML = xhr.responseText;

            // Count the number of present and absent students
            var presentCount = document.querySelectorAll('.ptable tbody tr').length;
            var absentCount = document.querySelectorAll('.atable tbody tr').length;

            // Update the elements in the box-info ul
            document.querySelector('.box-info li:nth-child(1) h3').textContent = presentCount;
            document.querySelector('.box-info li:nth-child(2) h3').textContent = absentCount;
            document.querySelector('.box-info li:nth-child(3) h3').textContent = presentCount + absentCount;
            
            // Attach event listeners to the toggle buttons
            var toggleButtons = document.getElementsByClassName('toggle-btn');
            Array.from(toggleButtons).forEach(function (button) {
                button.addEventListener('click', function () {
                    // Handle button click
                    var studentID = button.getAttribute('data-student-id');
                    var currentStatus = button.getAttribute('data-current-status');

                    // Get the current timestamp
                    var currentTimestamp = "<?php echo date('Y-m-d H:i:s'); ?>";

                    // Check if the selected date is the present date
                    if (date === currentDate) {
                        // Toggle the status and update the button appearance
                        if (currentStatus === 'present') {
                            moveStudentToAbsent(studentID, currentTimestamp);
                        } else {
                            moveStudentToPresent(studentID, currentTimestamp);
                        }

                        // TODO: Send AJAX request to update the attendance status in the database
                        updateAttendanceStatus(studentID, currentStatus, date, currentTimestamp);
                    } else {
                        alert("You can only update attendance for the present date.");
                    }
                });
            });
        }
    };
    xhr.open('POST', 'filter.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('course=' + course + '&academic_year=' + academic_year + '&section=' + section + '&date=' + date);
}

function updateAttendanceStatus(studentID, currentStatus, date, currentTimestamp) {
    // TODO: Implement AJAX request to update the attendance status in the database
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response if needed
            console.log(xhr.responseText);
            // After updating status, fetch attendance again to refresh tables
            fetchAttendance();
        }
    };
    xhr.open('POST', 'update_status.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('studentID=' + studentID + '&status=' + currentStatus + '&date=' + date + '&timestamp=' + currentTimestamp);
}

function moveStudentToPresent(studentID, currentTimestamp) {
    // Find the student's row in the absent table
    var absentTable = document.querySelector('.atable tbody');
    var studentRow = absentTable.querySelector('tr[data-student-id="' + studentID + '"]');

    if (studentRow) {
        // Remove the row from the absent table
        absentTable.removeChild(studentRow);

        // Update the timestamp in the database before moving to the present table
        updateAttendanceStatus(studentID, 'present', date, currentTimestamp);

        // Append the row to the present table
        var presentTable = document.querySelector('.ptable tbody');
        presentTable.appendChild(studentRow);
    }
}

function moveStudentToAbsent(studentID, currentTimestamp) {
    // Find the student's row in the present table
    var presentTable = document.querySelector('.ptable tbody');
    var studentRow = presentTable.querySelector('tr[data-student-id="' + studentID + '"]');

    if (studentRow) {
        // Remove the row from the present table
        presentTable.removeChild(studentRow);

        // Append the row to the absent table
        var absentTable = document.querySelector('.atable tbody');
        absentTable.appendChild(studentRow);

        // Update the timestamp in the database
        updateAttendanceStatus(studentID, 'absent', date, currentTimestamp);
    }
}
</script>
    <script src="script.js"></script>
    
</body>
</html>
