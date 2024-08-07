
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
          header("Location: teacher_dashboard.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare .com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins" , sans-serif;
      }
      body{
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: white;
        background-size: cover;
        padding: 30px;
      }
      .container{
        position: relative;
        padding: 40px 30px;
        perspective: 2700px;

      }

    .wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
}

.logo {
    width: 80px;
    margin: auto;
}

.logo img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0px 0px 3px #5f5f5f,
        0px 0px 0px 5px #ecf0f3,
        8px 8px 15px #a7aaa7,
        -8px -8px 15px #fff;
}

.wrapper .name {
    font-weight: 600;
    font-size: 1.4rem;
    letter-spacing: 1.3px;
    padding-left: 10px;
    color: #555;
}

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px;
    /* border: 1px solid red; */
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
}

.wrapper .form-field .fas {
    color: #fdc314af;
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #fdc314af;
    color: #fff;
    border-radius: 25px;
    box-shadow: 3px 3px 3px #b1b1b1,
        -3px -3px 3px #fff;
    letter-spacing: 1.3px;
}

.wrapper .btn:hover {
    background-color: #fdc31fff;
}

.wrapper a{
    text-decoration: underline;
    font-size: 0.8rem;
    color: green;
}
.wrapper  p{
    text-decoration: none;
    font-size: 0.8rem;
    color: black;
}

.wrapper a:hover {
    color: black;
}
.title{
  font-weight: 600;
  font-size: 3rem;
  letter-spacing: 1.3px;
  color: #555;
  text-align: center;
}
@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px;
    }
}
.error-message{
    color: red;
}
    </style>
   </head>
   
<body>

  <div class="container">
  <!-- <div class="title">
      Attendance Monitoring System
  </div> -->
  <div class="wrapper">
        <div class="logo">
            <img src="3D/logo.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Teacher Login
        </div>
        <form class="p-3 mt-3" id="teacherLoginForm"  method="post">
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-user"></span>
                <input name="Tusername" type="text" placeholder="Enter username" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input name="Tpassword" type="password" placeholder="Enter your password" required>
            </div>
            <?php
          if ($authenticationError) {
              echo '<div class="error-message">Invalid username or password</div>';
          }
          ?>
            <button class="btn mt-3" name="Tlogin" type="submit" value="Login">Login</button>
        </form>
        <div class="text-center fs-6">
            <p>Login as <a href="admin_login.php">Admin</a></p> 
        </div>
    </div>
  </div>
  </div>
  <script>

</script>
</body>
</html>

</html>

