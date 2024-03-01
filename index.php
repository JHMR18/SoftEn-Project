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
          header("Location: teacher_dash.php");
      } elseif ($user_type === "admin") {
          header("Location: ADMIN.php");
      }
      exit();
    } else {
        // Authentication failed, display an error message
        $authenticationError = true;
        //echo '<script type="text/javascript">alert("Authentication failed");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare .com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
      .desk{
        position: absolute;
        bottom: 1vh;
        left: -1vw;
        overflow: hidden;
      }
      .pencilcup{
        position: absolute;
        bottom: 30vh;
        left: -1vw;
        overflow: hidden;
      }
      .cap{
        position: absolute;
        top: -1vh;
        left: 3.5vw;
      }
      .school{
        position: absolute;
        top: -3vh;
        left: 40vw;
      }
      .laptop2{
        position: absolute;
        bottom: 0vh; 
        right: 0vw;
      }
      .calcu{
        position: absolute;
        bottom: 40vh;
        right: 1vw;
        
      }
      .booksingle{
        position: absolute;
        top: 1vh;
        right: 1vw;
      }
      .books{
        position: absolute;
        bottom: 0vh;
        left: 25vw;
        overflow: hidden;
      }
      .pencilcase{
        position: absolute;
        bottom: 0vh;
        left: 50vw;
        overflow: hidden;
      }
      /* loading screen */
      #loading-screen {
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: white;
  z-index: 1000;
  opacity: 1; /* Initial opacity */
  transition: opacity 0.5s ease; /* Transition for opacity change */
}
.logo {
  width: 500px; /* Adjust the width of your logo */
  height: 500px; /* Adjust the height of your logo */
  animation: pulse 1s infinite alternate; /* Pulsating animation */
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.1);
  }
}

#home {
  display: none; /* Initially hide the content */
}
    </style>
   </head>
   
<body>
<div id="loading-screen">
<img src="3D/logo.png" alt="Logo" class="logo" >
  </div>
  <div class="home">
  <div class="desk">
  <img src="3D/desk.png" alt="" width="300" height="200">
  </div>
  <div class="cap">
  <img src="3D/cap.png" alt="" width="300" height="200">
  </div> 
  <div class="laptop2">
  <img src="3D/laptop2.png" alt="" width="300" height="300">
  </div>
  <div class="booksingle">
  <img src="3D/bookssingle.png" alt="" width="200" height="200">
  </div>
  <div class="books">
  <img src="3D/books.png" alt="" width="200" height="200">
  </div>
  <div class="school">
  <img src="3D/school.png" alt="" width="300" height="300">
  </div>
  <div class="pencilcup">
  <img src="3D/pencilcup.png" alt="" width="300" height="300">
  </div>
  <div class="calcu">
  <img src="3D/calcu.png" alt="" width="200" height="200">
  </div>
  <div class="pencilcase">
  <img src="3D/pencilcase.png" alt="" width="200" height="200">
  </div>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img class="frontimg" src="Images/school.png" alt="">
        <div class="text">
          <span class="text-1">Onwards to a<br> Smarter Tayabas</span>
          <span class="text-2">Your Future Starts Here</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="Images/back.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2"></span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="teacher-login">
          <div class="title">Teacher Login</div>
          <form action="Teacher_dashboard.php" method="post">
    <div class="input-boxes">
        <div class="input-box">
            <i class="fas fa-user"></i>
            <input name="Tusername" type="text" placeholder="Enter username" required>
        </div>
        <div class="input-box">
            <i class="fas fa-lock"></i>
            <input name="Tpassword" type="password" placeholder="Enter your password" required>
        </div>
        <!-- <div class="text"><a href="#">Forgot password?</a></div> -->
        <!-- <span class="show-password" onclick="showPassword('Tpassword')">Show Password</span> -->
        <?php
          if ($authenticationError) {
              echo '<div class="error-message">Invalid username or password</div>';
          }
          ?>
        <div class="button input-box">
            <input name="Tlogin" type="submit" value="Login">
        </div>
        <div class="text sign-up-text">Not a teacher? Login as <label for="flip">Admin</label></div>
    </div>
</form>
<!-- <script> -->
    <!-- function showPassword(inputId) { -->
        <!-- var passwordInput = document.getElementById(inputId); -->
        <!-- if (passwordInput.type === "password") { -->
            <!-- passwordInput.type = "text"; -->
        <!-- } else { -->
            <!-- passwordInput.type = "password"; -->
        <!-- } -->
    <!-- } -->
<!-- </script> -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    // Update opacity to 0 for a fade-out effect
    document.getElementById('loading-screen').style.opacity = '0';

    // After the transition, hide the loading screen and show the content
    setTimeout(function () {
      document.getElementById('loading-screen').style.display = 'none';
      document.getElementById('content').style.display = 'block';
    }, 500); // 500ms should match the duration of the transition
  }, 2000);
});
</script>
        </div>
        <div class="admin-login">
          <div class="title">Admin Login</div>
          <form action="index.php" method="post">
    <div class="input-boxes">
        <div class="input-box">
            <i class="fas fa-user"></i>
            <input name="Ausername" type="text" placeholder="Enter username" required>
        </div>
        <div class="input-box">
            <i class="fas fa-lock"></i>
            <input name="Apassword" type="password" placeholder="Enter your password" required>
        </div>
        <?php
          if ($authenticationError) {
              echo '<div class="error-message">Invalid username or password</div>';
          }
          ?>
        <div class="button input-box">
            <input name="Alogin" type="submit" value="Login">
        </div>
        <div class="text sign-up-text">Login as a <label for="flip">Teacher</label></div>
    </div>
</form>

        </div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>

</html>
