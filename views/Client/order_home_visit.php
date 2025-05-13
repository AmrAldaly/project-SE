<?php
require_once '../../controls/home_visitController.php';
require_once '../../models/home_visit.php';


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




$controller = new home_visitController();
$success = "";
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (!empty($_POST["address"]) && !empty($_POST["reason"])&& !empty($_POST["contact"])&& !empty($_POST["datetime"])) {
    $home_visit=new home_visit();
    $home_visit->patient_id = $_SESSION['userId'];
    $home_visit->patient_name=$_POST['patient_name'];
    $home_visit->visit_datetime = $_POST['datetime'];
    $home_visit->reason = $_POST['reason'];
    $home_visit->address = $_POST['address'];
    $home_visit->contact=$_POST['contact'];

    if ($controller->order_home_visit($home_visit)) {
        $success = "Order Home Visit request submitted successfully!";
    } else {
        $error = $_SESSION["errmsg"];
        }
    } else {
        $error = "Please fill out all required fields.";
    }
}
?>














<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Home Visit - Clinic Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons (Optional, for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
        <?php include '../Client/navbar.php'; ?>
    
       <?php include '../includes/sidebar.php'; ?>

    
    <!-- Main Content -->
    <div class="main-content">
        <h1 class="h2 mb-4">Order a Home Visit</h1>
        
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

        
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Home Visit Service</h4>
            <p>Request a doctor or nurse to visit you at home. Please note that home visit availability may be limited to certain areas and times.</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Home Visit Request Form</h5>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="homeVisitPatientName" class="form-label">Patient Name</label>
                        <input type="text" name="patient_name" class="form-control" id="homeVisitPatientName" value="<?php echo $_SESSION['userName']." ". $_SESSION['userLastName'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="homeVisitAddress" class="form-label">Address for Visit</label>
                        <textarea name="address" class="form-control" id="homeVisitAddress" rows="3" placeholder="Enter the full address for the home visit"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="homeVisitContact" class="form-label">Contact Phone Number</label>
                        <input type="tel" name="contact" class="form-control" id="homeVisitContact" placeholder="Enter a contact number">
                    </div>
                    <div class="mb-3">
                        <label for="homeVisitReason" class="form-label">Reason for Home Visit</label>
                        <textarea name="reason" class="form-control" id="homeVisitReason" rows="3" placeholder="Briefly describe the reason for the home visit"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="homeVisitDateTime" class="form-label">Preferred Date and Time</label>
                        <input type="datetime-local" name="datetime" class="form-control" id="homeVisitDateTime">
                    </div>
                    <button type="submit" class="btn btn-primary">Request Home Visit</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/order_home_visit_script.js"></script> -->
</body>
</html>
