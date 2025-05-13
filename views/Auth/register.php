<?php
require_once  '../../models/User.php';
require_once '../../controls/AuthController.php';

$errmsg="";
if (isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["address"])&& isset($_POST["role"]) && isset($_POST["password"])&& isset($_POST["confirm_password"]))
{
    
    if (!empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["address"])&& !empty($_POST["role"]) && !empty($_POST["password"])&& !empty($_POST["confirm_password"]))
    {

      

        
        $user=new User();
        $user->email =$_POST["email"];
        $user->password =$_POST["password"];
        $user->first_name=$_POST["first_name"];
        $user->last_name=$_POST["last_name"];
        $user->role=$_POST["role"];
        $user->phone=$_POST["phone"];
        $user->address=$_POST["address"];
        $auth=new AuthController();


if ($_POST["password"] != $_POST["confirm_password"])
      {
            
            $errmsg= " Invalid password";
      }
      else
      {
        if (!$auth->register($user)){
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
        }
    
    }
}
    else 
    {
        $errmsg =" Please fill all fields ";
    }
}





?>










<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register - MPMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php if (!empty($errmsg)): ?>
        <div class="alert alert-danger"><?php echo $errmsg; ?></div>
    <?php endif; ?>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Create an Account</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Register As</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">-- Select Role --</option>
                                <option value="patient">Patient</option>
                                <option value="doctor">Doctor</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Already have an account? <a href="login.php">Login here</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
