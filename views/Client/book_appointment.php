<?php
require_once  '../../models/appointment.php';
require_once '../../controls/AuthController.php';
require_once '../../controls/bookAppController.php';
require_once '../../models/user.php';

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



$success = "";
$errmsg = "";
$doctorController = new BookAppointmentController();
$doctors=$doctorController->getdoctors();

if (isset($_POST["patient_name"]) && isset($_POST["doctor_id"])&& isset($_POST["appointment_date"])&& isset($_POST["appointment_time"])&& isset($_POST["visit_reason"]))
{
    
    if (!empty($_POST["patient_name"]) && !empty($_POST["doctor_id"])&& !empty($_POST["appointment_date"])&& !empty($_POST["appointment_time"])&& !empty($_POST["visit_reason"]))
    {
    $appointment=new appointment();
    $appointment->patient_name=$_POST['patient_name'];
    $appointment->user_id = $_SESSION['userId'];  
    $appointment->doctor_id = $_POST['doctor_id'];
    $appointment->appointment_date = $_POST['appointment_date'];
    $appointment->appointment_time = $_POST['appointment_time'];
    $appointment->reason = $_POST['visit_reason'];




    $controller = new BookAppointmentController();
    $doctors=$controller->getdoctors();
    if ($controller->bookAppointment($appointment)) {
        $success = "Appointment booked successfully!";
    } else {
        $errmsg = $_SESSION['errmsg'];
    }




    $statusController=new BookAppointmentController();
    $statusController->updateAppointmentStatus($appointment);
  
}
}
?>




















<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - Clinic Management System</title>
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
        <h1 class="h2 mb-4">Book an Appointment</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Appointment Booking Form</h5>
                <p class="card-text">Please fill out the form below to book your appointment. This is a placeholder page and the form is not functional yet.</p>
                <form  method="POST">
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Patient Name</label>
                        <input type="text" name="patient_name"  class="form-control" id="patientName" placeholder="Enter your full name">
                    </div>
                    <div class="mb-3">
                        <label for="appointmentDate" class="form-label">Preferred Date</label>
                        <input type="date" name="appointment_date" class="form-control" id="appointmentDate">
                    </div>
                    <div class="mb-3">
                        <label for="appointmentTime" class="form-label">Preferred Time</label>
                        <input type="time" name='appointment_time' class="form-control" id="appointmentTime">
                    </div>
                    <div class="mb-3">
                        <label for="doctorSelection" class="form-label">Select Doctor (Optional)</label>
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
                        <label for="reasonForVisit" class="form-label">Reason for Visit</label>
                        <textarea class="form-control" name="visit_reason" id="reasonForVisit" rows="3" placeholder="Briefly describe the reason for your visit"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Request Appointment</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/book_appointment_script.js"></script> -->
</body>
</html>
