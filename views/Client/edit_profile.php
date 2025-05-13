<?php
require_once  '../../models/User.php';
require_once '../../controls/ProfileController.php';

session_start();
if (!isset($_SESSION['userRole']))
{
    header("location: ../Auth/login.php");
}
else 
{
    if ($_SESSION['userRole']!="patient"){
        header("location: ../Auth/login.php");
    }
}

$auth=new ProfileController();

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    
    $user=new User();

    $user->id=$_SESSION['userId'];
    $user->first_name=$_POST['name'];
    $user->email=$_POST['email'];
    $user->phone=$_POST['phone'];
    $user->address=$_POST['address'];

    

   
    if ($auth->edit($user)) {
        $success = "Profile updated successfully!";
    } else {
        $error = "Failed to update profile. Please try again.";
    }

  }


?>





<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile - Clinic Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons (Optional, for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

     <?php include '../Client/navbar.php'; ?>


      <?php include '../Client/sidebar.php'; ?>

    



    <!-- Main Content -->
    <div class="main-content">
        <h1 class="h2 mb-4">Manage Profile</h1>

    <?php if (!empty($errms)): ?>
        <div class="alert alert-success"><?php echo $errmsg; ?></div>
    <?php endif; ?>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Your Profile Information</h5>
                <p class="card-text">Update your personal details, contact information, and insurance details below.</p>
                <form  method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="fullName" value="<?php echo $_SESSION['userName']." ".$_SESSION['userLastName'] ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="emailAddress" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="emailAddress" value="<?php echo $_SESSION['userEmail']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" id="phoneNumber" value="<?php echo $_SESSION['userPhone'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                           <textarea name="address" class="form-control" rows="3"><?php echo $_SESSION['userAddress']; ?></textarea>
                    <hr>
                    <h5 class="mt-4">Insurance Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="insuranceProvider" class="form-label">Insurance Provider</label>
                            <input type="text" class="form-control" id="insuranceProvider" value="ABC Insurance Co.">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="policyNumber" class="form-label">Policy Number</label>
                            <input type="text" class="form-control" id="policyNumber" placeholder="XYZ123456789">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/manage_profile_script.js"></script> -->
</body>
</html>
