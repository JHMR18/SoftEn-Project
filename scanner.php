<!DOCTYPE html>
<html>
<head>
    <style>
        #video {
            max-width: 600px;
            margin: auto;
        }

        #scanButton {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Student ID Scanner</h2>
    <video id="video" autoplay></video>
    <button id="scanButton" onclick="scanStudentID()">Scan ID</button>

    <script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
    <script>
        async function scanStudentID() {
            try {
                const video = document.getElementById('video');
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
            
                const mediaStreamTrack = stream.getVideoTracks()[0];
                const imageCapture = new ImageCapture(mediaStreamTrack);
                const photoBlob = await imageCapture.takePhoto();
                const photoDataUrl = await blobToBase64(photoBlob);

                const code = jsQR(photoDataUrl, photoBlob.width, photoBlob.height);
                if (code) {
                    const studentID = code.data;

                    // Send the studentID to the server for processing
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'scanner.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log(xhr.responseText);
                        }
                    };
                    xhr.send('studentID=' + encodeURIComponent(studentID));
                }

                stream.getVideoTracks().forEach(track => track.stop());
            } catch (error) {
                console.error('Error scanning ID:', error);
            }
        }

        function blobToBase64(blob) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onloadend = () => resolve(reader.result.split(',')[1]) ;
                reader.onerror = reject;
                reader.readAsDataURL(blob);
            });
        }
        
    </script>
</body>
</html>
<?php
include 'model.php'; // Include the Model

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['studentID'])) {
        http_response_code(400);
        echo "Error: No studentID provided in the POST request.";
        exit();
    }

    $studentID = $_POST['studentID'];
    // Perform database operations with the scanned ID (you need to implement this)
    // Example: Insert a new record for the scan
    insertScanRecord($studentID, 'present');
}

function insertScanRecord($studentID, $attendanceStatus) {
    $conn = connectToDatabase();
}
?>