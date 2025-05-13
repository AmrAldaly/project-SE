<?php
require_once  '../../models/User.php';
require_once '../../controls/user_view_doctor_profile.php';
require_once '../../models/doctor.php';
require_once '../../controls/search_doctorController.php';
require_once '../../models/doctor.php';
require_once '../../controls/leaveReviewController.php';


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

$profileController = new viewDoctorProfileController;
$doctor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$profile = $profileController->getDoctorProfile($doctor_id);
$reviews = $profileController->getDoctorReviews($doctor_id);

if (!$profile) {
    $error = "Doctor profile not found.";
}





















?>






<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Doctor Profile - Clinic Management System</title>
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
    <div class="container mt-5">
    <h2>Doctor Profile</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php else: ?>
        <div class="card">
            <div class="card-header">
                Dr. <?php echo $profile[0]['first_name'] . ' ' . $profile[0]['last_name']; ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="https://via.placeholder.com/150" class="img-fluid rounded-circle mb-3" alt="Doctor Image">
                        <h5 class="card-title">Specialty: <?php echo $profile[0]['specialty']; ?></h5>
                        <p class="text-muted">
                            Availability: 
                            <?php echo $profile[0]['available'] ? '<span class="text-success">Available</span>' : '<span class="text-danger">Not Available</span>'; ?>
                        </p>
                        <a href="../Client/book_appointment.php? echo $doctor_id; ?>" class="btn btn-primary btn-sm mb-2">Book Appointment</a>
                        <a href="user_leave_review.php?doctor_id=<?php echo $doctor_id; ?>" class="btn btn-outline-secondary btn-sm">Leave a Review</a>
                    </div>
                    <div class="col-md-9">
                        <h6>Contact Information</h6>
                        <p>Email: <?php echo $profile[0]['email']; ?></p>
                        <p>Phone: <?php echo $profile[0]['phone']; ?></p>
                        <p>Clinic Address: <?php echo $profile[0]['clinic_address']; ?></p>

                        <h6>About Dr. <?php echo $profile[0]['last_name']; ?></h6>
                        <p>
                            Dr. <?php echo $profile[0]['first_name'] . ' ' . $profile[0]['last_name']; ?> is a highly qualified <?php echo strtolower($profile[0]['specialty']); ?> with extensive experience in providing quality healthcare.
                        </p>

                     <h6>Patient Reviews</h6>
<?php foreach ($reviews as $review): ?>
    <div class="mb-3">
        <p>
            <strong><?php echo $review['anonymous'] ? 'Anonymous' : $review['first_name'] . ' ' . $review['last_name']; ?></strong>
            - <?php echo $review['rating']; ?> Stars
        </p>
        <p><?php echo $review['comment']; ?></p>
        <small>Posted on <?php echo $review['created_at']; ?></small>
    </div>
<?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>