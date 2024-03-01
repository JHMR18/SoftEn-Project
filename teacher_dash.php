<!-- teacher_dashboard.php -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'model.php'; // Include the Model
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher.css">
    <title>Teacher's Dashboard</title>
</head>
<body> 

    <div class="dashboard-container">
        <h1>Teacher's Dashboard</h1>

        <!-- Form to filter attendance records -->
        <h2>Filter Student Attendance</h2>
        <div class="filter">
            <label for="course">Course:</label>
            <select name="course" id="course">
                <!-- Populate with course options from database -->
                <option value="BSCS">BSCS</option>
                <option value="BSTM">BSTM</option>
                <option value="BCAED">BCAEd</option>
                <option value="BSENTREP">BSEntrep</option>
                <!-- Add more options as needed -->
            </select>

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

            <label for="section">Section:</label>
            <select name="section" id="section">
                <!-- Populate with section options from database -->
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <!-- Add more options as needed -->
            </select>

            <label for="date">Date:</label>
            <input type="date" name="date" id="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : date('Y-m-d'); ?>" required>

            <button type="button" id="filter">Fetch Attendance</button>
            <!-- Logout button -->
            <a href="logout.php" class="logout-button">Logout</a>
        </div>

        <!-- Display attendance records in a table -->
        <div id="attendance-tables"></div>

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


    </div>

</body>
</html>
