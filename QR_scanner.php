<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student ID Scanner</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap');
        :root {
	        --poppins: 'Poppins', sans-serif;
	        --lato: 'Lato', sans-serif;
        }
        body{
            background-color: #FFCE26; 
        }
        label{ 
            font-family: var(--poppins);
            font-size: 20px;
            text-align: center;
            color: white;
            background-color:  #FFCE26;
            border-radius: 10px;
            width: 30%;
        }
        #text{
            font-family: var(--poppins);
            font-size: 20px;
            border: none;
            background-color: transparent;
            display: inline-block;
         
        }
        #text:read-only::placeholder  {
            font-family: var(--poppins);
            text-align: center;
            color: #000000;
            font-weight: bold;
            font-size: 25px;
        }
        #confirmationMessage{
            font-family: var(--poppins);
            font-size: 30px;

        }
        .col{
            font-family: var(--poppins);
            position: relative;
            bottom: 0;
            text-align: center; /* Center content within the column */
        }
        .container{
            background-image: url('3D/paper.jpg'); /* Specify the path to your image */
            background-size: cover; /* Optional: Set how the background image should be sized */
            background-position: center; /* Optional: Set the position of the background image */
            justify-content: center;    
            display: flex;
            align-items: center;
            margin-top: 2%  ;
            background-color: #eeeeee;
            border-radius: 10px;
            width: 80vw;
            height: 90vh;       
            box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.2); 
        }
        .video video{
            border-radius: 10px;
            box-shadow: ;
            box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.2); 
            margin-bottom: 15px;
        }
        .audio {    
            display: none; /* Hide the audio element */
        }
        .tittle h2{

            left: 26%;
            font-family: var(--poppins);
            position: absolute;
            font-weight: bold;
            top: 8%;
            font-size: 50px;
            text-align: center;
            color: #fdc214; 
        
        }
        .laptop2{
        position: absolute;
        bottom: 0%;
        right: 8%;
       
      }
      .springblue{
        position: absolute;
        top: 0%;
        left: 5%;
      }
      .files{
        position: absolute;
        top: 0%;
        right: 7%;
      }
      .pencilcup{
        position: absolute;
        bottom: 3%;
        left: 3%;
        overflow: hidden;
        transform: rotate(-10deg);
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
<audio class="audio" id="sound1" src="sounds/success.mp3" preload="auto"></audio>
<audio class="audio" id="sound2" src="sounds/exist.mp3" preload="auto"></audio>
<audio class="audio" id="sound3" src="sounds/wrong-buzzer-6268.mp3" preload="auto"></audio>
<div id="loading-screen">
<img src="3D/logo.png" alt="Logo" class="logo" >
  </div>
<div class="home">
<div class="container"> 
    <div class="laptop2">
        <img src="3D/laptop2.png" alt="" width="300" height="300">
    </div>
    <div class="pencilcup">
        <img src="3D/pencilcup.png" alt="" width="300" height="300">
    </div>
    <div class="springblue">
        <img src="3D/springblue.png" alt="" width="200" height="200">
    </div>
    <div class="files">
        <img src="3D/files.png" alt="" width="200" height="200">
    </div>
    <div class="tittle"><h2>Attendance Monitoring System</h2></div>
    <div class="row">
        <div class="video"> 
            <video id="preview" width="100%"></video>
        </div>
        <div class="col">
            <label>STUDENT NAME:  </label>
            <input type="text" name="text" id="text" readonly="" placeholder="Please Scan your ID">
            <div id="confirmationMessage"></div>
        </div>
    </div>
</div>
</div>

<script>
let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        alert('No cameras found');
    }
}).catch(function (e) {
    console.error(e);
});

scanner.addListener('scan', function (c) {
    // Send the studentID to the server for processing
    $.ajax({
        type: 'POST',
        url: 'process_scan.php', 
        data: { studentID: c },
        success: function (response) {
            console.log(response);

            // Display a confirmation message based on the response
            const confirmationMessage = document.getElementById('confirmationMessage');
            const audioSuccess = document.getElementById('sound1');
            const audioExist = document.getElementById('sound2');
            const audioFail = document.getElementById('sound3');

            if (response.trim() === 'success') {
                playSound(audioSuccess);
                confirmationMessage.innerHTML = '<p style="color: green;">Attendance taken successfully!</p>';
            } else if (response.trim() === 'attendance_exists') {
                // Display a popup or a message for existing attendance
                playSound(audioExist);
                confirmationMessage.innerHTML = '<p style="color: orange;">Attendance already taken!</p>';
            } else if (response.trim() === 'error') {
                playSound(audioFail);
                confirmationMessage.innerHTML = '<p style="color: red;">Failed to take attendance.</p>';
            }

            // Clear the message after a few seconds
            setTimeout(function () {
                confirmationMessage.innerHTML = '';
                document.getElementById('text').placeholder = "Please Scan your ID";
            }, 2000);
        },
        error: function (xhr, status, error) {
            console.error('Error:', xhr.responseText);
            // Display an error message
            const confirmationMessage = document.getElementById('confirmationMessage');
            confirmationMessage.innerHTML = '<p style="color: red;">Error: ' + xhr.responseText + '</p>';
        }
    });
});

function playSound(audioElement) {
        if (audioElement && typeof audioElement.play === 'function') {
            audioElement.play();
        }
    }
    scanner.addListener('scan', function (d) {
    $.ajax({
        type: 'POST',
        url: 'Get_Name.php',
        data: { action: 'getNamesByStudentID', studentID: d },
        success: function (response) {
            console.log(response);
            const inputText = document.getElementById('text');
            // Display the full name in the input placeholder
            document.getElementById('text').placeholder = response;
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    // Update opacity to 0 for a fade-out effect
    document.getElementById('loading-screen').style.opacity = '0';

    // After the transition, hide the loading screen and show the content
    setTimeout(function () {
      document.getElementById('loading-screen').style.display = 'none';
      document.getElementById('content').style.display = 'block';
    }, 500); // 500ms should match the duration of the transition
  }, 4000);
});
    </script>
</body>
</html>
