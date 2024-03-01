<!-- filter.php -->
<?php
// Include the Model
include 'model.php';

if (isset($_POST['course']) && isset($_POST['academic_year']) && isset($_POST['section']) && isset($_POST['date'])) {
    // Process form submission and fetch attendance records
    $course = $_POST['course']; 
    $academic_year = $_POST['academic_year'];
    $section = $_POST['section'];
    $date = $_POST['date'];

    // Check if the selected date is greater than the current date
    $currentDate = date('Y-m-d'); 
    if ($date > $currentDate) {
        echo '<p>No attendance records found for the selected filters.</p>';
    } else {
        // Fetch student attendance records
        $attendanceRecords = getStudentAttendance($course, $academic_year, $section, $date);

        if (!empty($attendanceRecords)) {
            echo '<div style="display: flex; justify-content: space-around;">
                    <div class="ptable" style="flex: 1;">
                        <h2 class="PRESENT" >Present Students</h2>
                        <table class="present" >
                            <thead> 
                                <tr>
                                    <th>Scan Time</th>
                                    <th>Student Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach ($attendanceRecords as $record) {
                                if ($record['attendanceStatus'] == 'present') {
                                    // Format the scan date in 12-hour format
                                    $formattedDate = date("g:i A", strtotime($record['scanDate']));
                            
                                    // Combine first, middle, and last names
                                    $fullName = $record['firstName'] . ' ' . $record['middleName'] . ' ' . $record['lastName'];
                            
                                    echo '<tr>
                                            <td>' . $formattedDate . '</td>
                                            <td>' . $fullName . '</td>
                                            <td><button class="toggle-btn" data-student-id="' . $record['studentID'] . '" data-current-status="present" style="background-color: red; font-family: var(--poppins);
                                            font-weight: bold; color: white;border: none;
                                            padding: 5px;
                                            border-radius: 4px;
                                            cursor: pointer;
                                            font-weight: bold;">Absent</button></td>
                                          </tr>';
                                }
                            } 

            echo '</tbody></table></div>';

            echo '<div class="atable" style="flex: 1;">
                        <h2 class="ABSENT" >Absent Students</h2>
                        <table class="absent" >
                            <thead>
                                <tr>
                                    <!-- <th>Scan Time </th> -->
                                    <th>Student Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach ($attendanceRecords as $record) {
                                if ($record['attendanceStatus'] == 'absent') {
                                    // Combine first, middle, and last names
                                    $fullName = $record['firstName'] . ' ' . $record['middleName'] . ' ' . $record['lastName'];
                            
                                    echo '<tr>
                                                <td>' . $fullName . '</td>
                                                <td><button class="toggle-btn" data-student-id="' . $record['studentID'] . '" data-current-status="absent" style="background-color: green;font-family: var(--poppins);
                                                font-weight: bold; color: white; border: none;
                                                padding: 5px;
                                                border-radius: 4px;
                                                cursor: pointer;
                                                font-weight: bold;">Present</button></td>
                                              </tr>';
                                }
                            }

            echo '</tbody></table></div></div>';
        } else {
            echo '<p>No attendance records found for the selected filters.</p>';
        }
    }
}
?>
