<?php
require_once  '../../models/telehealth_calls.php';
require_once '../../controls/userVoiceVideoCallController.php';
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

$doctors_controller=new BookAppointmentController();
$callController = new userVoiceVideoCallController();
$success = "";
$error = "";
$doctors=$doctors_controller->getdoctors();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['schedule'])) {
    $call=new telehealth_calls();
    $call->doctor_id = $_POST['doctor_id'];
    $call->patient_id = $_SESSION['userId'];
    $call->call_datetime = $_POST['call_datetime'];
    $call->reason = $_POST['reason'];
   

    if ($callController->scheduleCall($call)) {
        $success = "Telehealth call scheduled successfully!";
    } else {
        $error = "Failed to schedule call. Please try again.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check_availability'])) {
    $doctor_id = intval($_POST['doctor_id']);
    $availability = $callController->checkDoctorAvailability($doctor_id);
    $message = $availability ? "Doctor is available for a call." : "Doctor is not available.";
}










?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice/Video Call - Clinic Management System</title>
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
    <!-- Sidebar -->
      <?php include '../Client/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="h2 mb-4">Voice/Video Call with a Doctor</h1>

        
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif (!empty($message)): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

        
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Telehealth Consultation</h4>
            <p>Connect with a doctor remotely via voice or video call. Please ensure you have a stable internet connection and a private space for your consultation.</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Schedule or Start a Telehealth Call</h5>
                <p>You can schedule a call for a future time or, if a doctor is available, start an immediate consultation.</p>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <h6>Schedule a Call</h6>
                        <form method="POST">
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
                                <label for="telehealthDateTime" class="form-label">Preferred Date and Time</label>
                                <input name="call_datetime" type="datetime-local" class="form-control" id="telehealthDateTime">
                            </div>
                            <div class="mb-3">
                                <label for="telehealthReason" class="form-label">Reason for Call</label>
                                <textarea name="reason" class="form-control" id="telehealthReason" rows="3" placeholder="Briefly describe the reason for your call"></textarea>
                            </div>
                            <button type="submit" name="schedule" class="btn btn-primary">Schedule Call</button>
                        </form>
                     <h5 class="mt-4">Check Immediate Availability</h5>
            <form method="POST">
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
                <button type="submit" name="check_availability" class="btn btn-success">Check Availability</button>
            </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/voice_video_call_script.js"></script> -->
</body>
</html>
