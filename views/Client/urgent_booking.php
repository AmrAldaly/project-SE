<?php
require_once '../../controls/urgentBookingController.php';
require_once '../../models/urgent_booking.php';


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




$controller = new UrgentBookingController();
$success = "";
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (!empty($_POST["phone"]) && !empty($_POST["reason"])) {
    $urgent=new urgent_booking();
    $urgent->patient_id = $_SESSION['userId'];
    $urgent->patient_name=$_POST['patient_name'];
    $urgent->phone = $_POST['phone'];
    $urgent->reason = $_POST['reason'];
    $urgent->time_slot = $_POST['time_slot'];

    if ($controller->addUrgentBooking($urgent)) {
        $success = "Urgent booking request submitted successfully!";
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
    <title>Urgent Booking - Clinic Management System</title>
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
        <h1 class="h2 mb-4">Urgent Booking Request</h1>
        
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
        
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Important Notice!</h4>
            <p>This form is for urgent booking requests. Availability is limited and subject to confirmation. For life-threatening emergencies, please call emergency services immediately.</p>
            <hr>
            <p class="mb-0">Our team will contact you as soon as possible to confirm your urgent appointment.</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Urgent Appointment Details</h5>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="urgentPatientName" class="form-label">Patient Name</label>
                        <input type="text" name="patient_name" class="form-control" id="urgentPatientName" value="<?php echo $_SESSION['userName']." ". $_SESSION['userLastName'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="urgentPhoneNumber" class="form-label">Contact Phone Number</label>
                        <input type="tel" name="phone"  class="form-control" id="urgentPhoneNumber" placeholder="Enter a phone number we can reach you at urgently">
                    </div>
                    <div class="mb-3">
                        <label for="reasonForUrgentVisit" class="form-label">Reason for Urgent Visit</label>
                        <textarea name="reason" class="form-control" id="reasonForUrgentVisit" rows="4" placeholder="Briefly describe the urgent medical issue"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="preferredTimeSlot" class="form-label">Preferred Time Slot (if any)</label>
                        <input type="text" name="time_slot" class="form-control"  id="preferredTimeSlot" placeholder="e.g., ASAP, This Afternoon, Tomorrow Morning">
                    </div>
                    <button type="submit" class="btn btn-danger">Submit Urgent Request</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/urgent_booking_script.js"></script> -->
</body>
</html>
