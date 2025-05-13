<?php
require_once  '../../models/User.php';
require_once '../../controls/AuthController.php';

$errmsg="";
if (isset($_POST["email"]) && isset($_POST["password"]))
{
    
    if (!empty($_POST["email"]) && !empty($_POST["password"]))
    {
        $user=new User();
        $user->email =$_POST["email"];
        $user->password =$_POST["password"];
        $auth=new AuthController();
        if (!$auth->login($user)){
            if (!isset($_SESSION["userId"])){
            session_start();
            }
        $errmsg=$_SESSION["errmsg"];
        }
        else 
        {
            if ($_SESSION["userRole"]=="patient"){
                header("location: ../Client/patient.php");
            }
            if ($_SESSION["userRole"]=="doctor"){
                header("location: ../Client/doctor.php");
            }
            if ($_SESSION["userRole"]=="admin"){
                header("location: ../Admin/admin.php");
            }
        }
    }
    else 
    {
        $errmsg =" Please write the email and password ";
    }
}


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clinic Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Styles specific to login page, already LTR compatible */
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card login-card">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>
                <div id="error-message" class="alert alert-danger d-none" role="alert">
                    <!-- Error messages will be displayed here -->
                     <?php echo $errmsg ;?>
                </div>
                <form id="login-form" method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email / Username</label>
                        <input type="text" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#">Forgot Password?</a>
                    </div>                    <div class="text-center mt-2">
                        <span>Are you a patient? </span><a href="user_appointment_request.html">Request Appointment</a>
                    </div>
                    <div class="text-center mt-2">
                        <span>Don't have an account? </span><a href="../Auth/register.php">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script>
        document.getElementById('login-form')?.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent actual form submission
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorMessageDiv = document.getElementById(<?php echo $errmsg ?>);

            // Clear previous error messages
            if (errorMessageDiv) {
                errorMessageDiv.classList.add('d-none');
                errorMessageDiv.textContent = <?php $errmsg ?>;
            }

            // Admin login
        
            // Invalid credentials
            else {
                if (errorMessageDiv) {
                    errorMessageDiv.textContent = "Invalid credentials"; 
                    errorMessageDiv.classList.remove('d-none');
                }
            }
        });
    </script>
</body>
</html>
