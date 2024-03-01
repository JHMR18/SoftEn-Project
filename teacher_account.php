<?php


// Start the session
session_start();

// Retrieve the username from the session
$username = $_SESSION['username'];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "G3");

// Check the connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
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
	<link rel="stylesheet" href="ADMINSTYLE.css">
	<title>Teachers</title>
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
            background-color: rgba(0,0,0,0.4);
            
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
			<span class="text">Onwarsds to a Smarter Tayabas!</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="teacher_dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="teacher_account.php">
					<i class='bx bxs-book-reader' ></i>
					<span class="text">Update Account</span>
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


    <!-- Add and Update Teacher Forms -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="profile">
                <img src="icons/user.png" alt="">
            </a>    
            <a href="#" class="nav-link"><h1><?php echo $username ?></h1></a>
        </nav>
    </section>    
    <section id="form">
        <form method="POST">
			<h2>Update Account</h2>
			<input type="text" name="teacherUsernameToUpdate" placeholder="Teacher Username to Update">
			<input type="text" name="updatedUsername" placeholder="Updated Username">
			<input type="password" name="updatedPassword" placeholder="Updated Password">
			<input type="text" name="updatedCourse" placeholder="Updated Program">
			<button type="submit" name="updateTeacher">Update Teacher</button>


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
	</script>
    <script src="script.js"></script>
<?php
// Query to fetch teacher information from the database
$query = "SELECT username, user_type, course FROM users WHERE user_type = 'teacher'";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query execution failed: " . mysqli_error($conn));
}
// Update Teacher Functionality
if (isset($_POST["updateTeacher"])) {
    $teacherUsernameToUpdate = $_POST["teacherUsernameToUpdate"];
    $updatedUsername = $_POST["updatedUsername"];
    $updatedPassword = $_POST["updatedPassword"];
    $updatedCourse = $_POST["updatedCourse"];

    // Hash the updated password (for security, consider using password_hash in a real application)
    $hashedPassword = password_hash($updatedPassword, PASSWORD_DEFAULT);

    // Update the teacher's information in the database based on username
    $updateQuery = "UPDATE users SET username = '$updatedUsername', password = '$hashedPassword', course = '$updatedCourse' 
                    WHERE user_type = 'teacher' AND username = '$teacherUsernameToUpdate'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>showNotification('Teacher Info Updated', true);</script>";
    } else {
        echo "<script>showNotification('Error Updating Teacher Info: " . mysqli_error($conn) . "', false);</script>";
    }
}

?>
</body>
</html>
