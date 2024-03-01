<!DOCTYPE html>
<html>
  <head>
    <title>ADMIN ENROLL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');       
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: "Poppins",sans-serif;
      font-size: 16px;
      color: #eee;
      }
      body {
  /*    background: url("Images/school.jpg") no-repeat center;*/
        background-color:#fdc314c7;
      background-size: cover;
      }
      h1, h2 {
      font-family: "Poppins",sans-serif;
      font-weight: 400;
    
      }
      h2 {
      margin: 0 0 0 8px;
      color: black;
      }
      .main-block {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 25px;
      }
      .left-part, form {
      padding: 25px;
      }
      .left-part {
      text-align: center;
      }
      .fa-graduation-cap {
      font-size: 72px;
    ;
      }
      form {
      background: rgba(0, 0, 0, 0.7); 
      border-radius: 15px;
      background-color: white;
      }
      .title {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    
      }
      .title i,h2{
        color:#fdc214;
        
      }
    
      .info {
      display: flex;
      flex-direction: column;
      }
      input, select {
      padding: 5px;
      margin-bottom: 30px;
      background: transparent;
      border: none;
      border-bottom: 1px solid #929292;
      border-radius: 10px;
      color: #000000;
      }
      input::placeholder {
      color: #000000;
      }
      option:focus {
      border: none;
      }
      option {
      background: black; 
      border: none;
      }
      select{
        color: #000000;
      }
      .checkbox input {
      margin: 0 10px 0 0;
      vertical-align: middle;
      }

      .btn-item, button {
      padding: 10px 5px;
      margin-top: 20px;
      border-radius: 10px; 
      border: none;
      background: #fdc214;
      text-decoration: none;
      font-size: 15px;
      font-weight: 400;
      color: #ffffff;
      }
      span{
        color: #000000;
      }
      .btn-item {
      display: inline-block;
      margin: 20px 5px 0;
      }
      button {
      width: 100%;
      background: #fdc214;
      }
      button:hover, .btn-item:hover {
      background: #15552c;
      }
      @media (min-width: 568px) {
      html, body {
      height: 100%;
      }
      .main-block {
      flex-direction: row;
      height: calc(100% - 50px);
      }
      .left-part, form {
      flex: 1;
      height: auto;
      }
      }
    </style>
  </head>
  <body>
    <div class="main-block">
      <div class="left-part">
        <i class="fas fa-graduation-cap"></i>
        <h1>Onwards To a Smarter tayabas</h1>

        <div class="btn-group">
          <a class="btn-item" href="ADMIN.html">Dashboard</a>
        </div>
      </div>
      <form action="/">
        <div class="title">
          <i class="fas fa-pencil-alt"></i> 
          <h2>Enroll Student</h2>
        </div>
        <div class="info">
          <input class="fname" type="text" name="name" placeholder="First name">

          <input type="text" name="name" placeholder="Middle name">

          <input type="text" name="name" placeholder="Last name">

          <input type="text" name="name" placeholder="ID Number"> 
          <select>
            <option value="BSCS" selected><span>BSCS</span></option>
            <option value="short-courses">Short courses</option>
            <option value="featured-courses">Featured courses</option>
            <option value="undergraduate">Undergraduate</option>
            <option value="diploma">Diploma</option>
            <option value="certificate">Certificate</option>
            <option value="masters-degree">Masters degree</option>
            <option value="postgraduate">Postgraduate</option>
          </select>
        </div>
        <button type="submit" href="/">Enroll</button>
      </form>
    </div>
  </body>
</html>