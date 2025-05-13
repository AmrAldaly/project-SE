<?php 
require_once '../../controls/leaveReviewController.php';
require_once '../../models/review.php';
require_once '../../controls/user_view_doctor_profile.php';
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
$controller = new leaveReviewController();
$success = "";
$error = "";
$doctors=$doctors_controller->getdoctors();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review=new review();
    $review->doctor_id = $_POST['doctor_id'];
    $review->patient_id = $_SESSION['userId']; 
    $review->rating = intval($_POST['rating']);
    $review->comment = $_POST['comment'];
    $anonymous = isset($_POST['anonymous']) ? 1 : 0;

    if ($controller->leaveReview($review)) {
        $success = "Review submitted successfully!";
    } else {
        $error = "Failed to submit review. Please try again.";
    }
}


























?>







<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Review - Clinic Management System</title>
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

    <!-- Sidebar -->
       

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="h2 mb-4">Leave a Review and Rating</h1>

            <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Share Your Experience</h5>
                <p class="card-text">We value your feedback! Please share your experience with our services or a specific doctor. This is a placeholder page and the form is not functional yet.</p>
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
                        <label for="rating" class="form-label">Overall Rating</label>
                        <div>
                            <!-- Basic star rating example (can be enhanced with JS) -->
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                        </div>
                        <select name="rating" class="form-select mt-2" id="ratingSelect">
                            <option selected>Select rating...</option>
                            <option value="5">5 Stars (Excellent)</option>
                            <option value="4">4 Stars (Good)</option>
                            <option value="3">3 Stars (Average)</option>
                            <option value="2">2 Stars (Poor)</option>
                            <option value="1">1 Star (Very Poor)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reviewComments" class="form-label">Your Comments</label>
                        <textarea name="comment" class="form-control" id="reviewComments" rows="5" placeholder="Please provide details about your experience..."></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input name="anonymous" class="form-check-input" type="checkbox" value="" id="anonymousReview">
                        <label class="form-check-label" for="anonymousReview">
                            Submit review anonymously
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/leave_review_script.js"></script> -->
</body>
</html>
