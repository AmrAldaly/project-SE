<?php
require_once '../../controls/waitlistController.php';
require_once '../../models/waitlist.php';
require_once '../../controls/bookAppController.php';


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




$controller = new waitlistController();
$success = "";
$error = "";
$doctorController = new BookAppointmentController();
$doctors=$doctorController->getdoctors();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (!empty($_POST["start_date"]) && !empty($_POST["reason"])&& !empty($_POST["end_date"])) {
    $waitlist=new waitlist();
    $waitlist->patient_id = $_SESSION['userId'];
    $waitlist->doctor_id=$_POST['doctor_id'];
    $waitlist->patient_name=$_POST['patient_name'];
    $waitlist->start_date = $_POST['start_date'];
    $waitlist->reason = $_POST['reason'];
    $waitlist->end_date = $_POST['end_date'];

    if ($controller->join_waitlist($waitlist)) {
        $success = "Join Waitlist request submitted successfully!";
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
    <title>Join Waitlist - Clinic Management System</title>
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
       
       <?php include '../Client/sidebar.php'; ?>


    <!-- Main Content -->
    <div class="main-content">
        <h1 class="h2 mb-4">Join Waitlist</h1>
        
           <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
        
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">How Waitlists Work</h4>
            <p>If your preferred doctor or time slot is unavailable, you can join a waitlist. We will notify you if an earlier spot becomes available.</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Waitlist Request Form</h5>
                <form   method="POST" action="">
                    <div class="mb-3">
                        <label for="waitlistPatientName" class="form-label">Patient Name</label>
                        <input type="text" name="patient_name"  class="form-control" id="waitlistPatientName" value="<?php echo $_SESSION['userName']." ". $_SESSION['userLastName'] ?>">
                    </div>
                     <div class="mb-3">
                        <label for="doctorSelection" class="form-label">Preffered Doctor (if any)</label>
                        <select class="form-select" name="doctor_id" id="doctorSelection">
                            <?php
                            foreach ($doctors as $doctor) {
                            ?>

                            <option value="<?php echo $doctor["id"] ?>"><?php echo $doctor["first_name"]." ".$doctor["last_name"]?></option>
                            <?php
                            }
                            ?>
                          
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="waitlistDateRange" class="form-label">Preferred Date Range</label>
                        <div class="input-group">
                            <input type="date" name="start_date" class="form-control" id="waitlistStartDate">
                            <span class="input-group-text">to</span>
                            <input type="date" name="end_date" class="form-control" id="waitlistEndDate">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="waitlistReason" class="form-label">Reason for Visit</label>
                        <textarea name="reason" class="form-control" id="waitlistReason" rows="3" placeholder="Briefly describe the reason for your visit"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Join Waitlist</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/join_waitlist_script.js"></script> -->
</body>
</html>
