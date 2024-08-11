<?php
session_start(); 
include("connection.php");
include("Auth.php");
if (isset($_SESSION["logged_in"]) && $_SESSION['logged_in'] === true) {
    header("Location: List.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Login_User</title>
    <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(218, 41%, 35%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    .AdminLogin {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      color: #fff;
      background-color: #007bff; /* Primary blue color */
      border: none;
      border-radius: 50px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
    }

    .AdminLogin:hover {
      background-color: #0056b3; /* Darker blue on hover */
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .AdminLogin:active {
      transform: scale(0.98); /* Slightly scale down on click */
    }

    .AdminLogin:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(38, 143, 255, 0.5); /* Blue focus ring */
    }

    .bg-glass {
      background-color: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login {
      padding: 20px;
    }

    .login .form-outline {
      margin-bottom: 15px;
    }
    .flex_Social {
  display: flex;
  justify-content: space-evenly;
  align-items: center; /* Optional: centers items vertically */
}

.social {
  width: 60px;  /* Adjust size as needed */
  height: 50px; /* Adjust size as needed */
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none; /* Remove button border if not needed */
  background: transparent; /* Remove default background */
}

.social img {
  width: 100%;  /* Ensure the image covers the button */
  height: 100%; /* Ensure the image covers the button */
  object-fit: cover; /* Maintain aspect ratio and cover the button */
}
    </style>
</head>
<body>
    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">
      <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
          <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
            <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
              Assignment for
              <br />
              <span style="color: hsl(218, 81%, 75%)">Quadiro Technologies.</span>
            </h1>
          </div>

          <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
            <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
            <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

            <div class="card bg-glass">
              <div class="card-body px-4 py-5 px-md-5">
                <form id="myForm" class="login" action="Auth.php" onsubmit="return isvalid()" method="POST">
                  <button class="AdminLogin" onclick="window.location.href='admin.Log_Admin.php';">
                    Login_Admin->
                  </button>
                  <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                      <div data-mdb-input-init class="form-outline">
                        <input type="text" name="fname" id="form3Example1" class="form-control" required />
                        <label class="form-label" for="form3Example1">First name</label>
                      </div>
                    </div>

                    <div class="col-md-6 mb-4">
                      <div data-mdb-input-init class="form-outline">
                        <input type="text" name="lname" id="form3Example2" class="form-control" required />
                        <label class="form-label" for="form3Example2">Last name</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form3Example3" class="form-control" required />
                    <label class="form-label" for="form3Example3">Email address</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form3Example4" class="form-control" required />
                    <label class="form-label" for="form3Example4">Password</label>
                  </div>


                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                      Sign in
                    </button>
                  </div>
                  <div class="flex_Social">
  <button class="social"><img src="./Images/facebook.png" alt="" height="32"></button>
  <button class="social"><img src="./Images/google.png" alt="" height="32"></button>
  <button class="social"><img src="./Images/twitter.png" alt="" height="32"></button>
</div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Q5iLV5l3gVj1/2EKzcc33PGaI0n95VdmoILy88JWfF14J7UtnWejw+0cYQsPfVph" crossorigin="anonymous"></script>

    <!-- Custom JavaScript -->
    <script>
    function isvalid() {
      var fname = document.getElementById('form3Example1').value;
      var lname = document.getElementById('form3Example2').value;
      var email = document.getElementById('form3Example3').value;
      var password = document.getElementById('form3Example4').value;
      var location = document.getElementById('form3Example5').value;
      var contact = document.getElementById('form3Example6').value;

      if (!fname || !lname || !email || !password || !location || !contact) {
        alert("Please fill out all fields.");
        return false;
      }

      // Further validation logic can go here

      return true; // Form is valid
    }
    </script>
</body>
</html>
