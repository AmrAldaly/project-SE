
<?php
require_once  '../../models/User.php';
require_once '../../controls/viewAppController.php';
require_once '../../controls/bookAppController.php';
require_once '../../models/appointment.php';



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




$controller = new ViewAppController();
$patient_id = $_SESSION['userId'];  
$appointments = $controller->getAppointments($patient_id);

$cancel_controller=new BookAppointmentController();
$reschedule_controller=new BookAppointmentController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        $appointment_id = $_POST['appointment_id'];
        if ($cancel_controller->cancel_appointment($appointment_id)) {
            $message = "Appointment canceled successfully!";
        } else {
            $errmsg = "Failed to cancel appointment.";
        }
    }



if (isset($_POST['reschedule'])) {
    if (!empty($_POST['new_date'])&&!empty($_POST['new_time'])){
    $new_appointment=new appointment();
    $new_appointment->appointment_id = $_POST['appointment_id'];
    $new_appointment->appointment_date = $_POST['new_date'];
    $new_appointment->appointment_time = $_POST['new_time'];
    if ($reschedule_controller->reschedule($new_appointment)) {
        $message = "Appointment rescheduled successfully!";
    } else {
        $error = "Failed to reschedule appointment.";
    }
}
}
}

?>




?>














<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments - Clinic Management System</title>
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
        <h1 class="h2 mb-4">My Upcoming Appointments</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Upcoming Appointments List</h5>
                <?php if (count($appointments) > 0): ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Doctor</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $index => $appointment): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $appointment['appointment_date']; ?></td>
                                <td><?php echo $appointment['appointment_time']; ?></td>
                                <td><?php echo $appointment['doctor_name'] ?: 'N/A'; ?></td>
                                <td><?php echo $appointment['reason']; ?></td>
                                <td><span class="badge bg-<?php echo $appointment['status'] === 'Cancelled' ? 'danger' : ($appointment['status'] === 'Confirmed' ? 'success' : 'warning'); ?>">
                                <?php echo ucfirst($appointment['status']); ?></span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info">Details</a>
                                    <?php if ($appointment['status'] !== 'Cancelled' && $appointment['status'] !== 'Completed'): ?>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#rescheduleModal<?php echo $appointment['appointment_id']; ?>">Reschedule</button>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                                <button type="submit" name="cancel" class="btn btn-danger btn-sm">Cancel</button>
                            </form>
                        <?php endif; ?>
                                </td>
                            </tr>
                             <!-- Reschedule Modal -->
                <div class="modal fade" id="rescheduleModal<?php echo $appointment['appointment_id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reschedule Appointment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <label for="new_date" class="form-label">New Date</label>
                                    <input type="date" name="new_date" class="form-control" required>
                                    <label for="new_time" class="form-label mt-2">New Time</label>
                                    <input type="time" name="new_time" class="form-control" required>
                                    <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="reschedule" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No upcoming appointments found.</p>
            <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/view_appointments_script.js"></script> -->
</body>
</html>
