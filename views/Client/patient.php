<?php   
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



?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Clinic Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons (Optional, for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .card-icon {
            font-size: 2.5rem;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
         <?php include '../Client/navbar.php'; ?>

            <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="../Client/patient.php" class="nav-link">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="../Client/book_appointment.php" class="nav-link">
                    <i class="bi bi-calendar-plus me-2"></i> Book Appointment
                </a>
            </li>
            <li>
                <a href="../Client/view_appointments.php" class="nav-link">
                    <i class="bi bi-calendar-event me-2"></i> View Upcoming Appointments
                </a>
            </li>
             <li>
                <a href="../Client/urgent_booking.php" class="nav-link">
                    <i class="bi bi-exclamation-triangle me-2"></i> Urgent Booking
                </a>
            </li>
            <li>
                <a href="../Client/join_waitlist.php" class="nav-link">
                    <i class="bi bi-person-lines-fill me-2"></i> Join Waitlist
                </a>
            </li>
            <li>
                <a href="../Client/order_home_visit.php" class="nav-link active" aria-current="page">
                    <i class="bi bi-house-heart me-2"></i> Order Home Visit
                </a>
            </li>
            <li>
                <a href="../Client/search_doctors.php" class="nav-link">
                    <i class="bi bi-search me-2"></i> Search Doctors
                </a>
            </li>
            <li>
                <a href="../Client/user_view_doctor_profile.php" class="nav-link">
                    <i class="bi bi-person-badge me-2"></i> View Doctor Profile
                </a>
            </li>
            <li>
                <a href="../Client/order_medicine.php" class="nav-link">
                    <i class="bi bi-capsule me-2"></i> Order Medicine
                </a>
            </li>
            <li>
                <a href="../Client/user_voice_video_call.php" class="nav-link">
                    <i class="bi bi-telephone-video me-2"></i> Voice/Video Call
                </a>
            </li>
            <li>
                <a href="../Client/user_leave_review.php" class="nav-link">
                    <i class="bi bi-star-half me-2"></i> Leave Review & Rating
                </a>
            </li>
            <li>
                <a href="../Client/user_contact_support.php" class="nav-link">
                    <i class="bi bi-headset me-2"></i> Contact Support
                </a>
            </li>
        </ul>
        <hr>
    </div>


      
  

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="h2 mb-4">Welcome to Your User Dashboard</h1>
        
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-4">
                <div class="card text-bg-primary h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-plus card-icon mb-2"></i>
                        <h5 class="card-title">Book a New Appointment</h5>
                        <p class="card-text">Find a doctor and book your appointment easily.</p>
                        <a href="../Client/book_appointment.php" class="btn btn-light">Go to Booking</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-bg-success h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-event card-icon mb-2"></i>
                        <h5 class="card-title">My Upcoming Appointments</h5>
                        <p class="card-text">View and manage your upcoming appointments.</p>
                        <a href="../Client/view_appointments.php" class="btn btn-light">View Appointments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card text-bg-info h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-person-fill-gear card-icon mb-2"></i>
                        <h5 class="card-title">Manage Profile</h5>
                        <p class="card-text">Update your personal information and preferences.</p>
                        <a href="../Client/edit_profile.php" class="btn btn-light">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Placeholder for other user-specific content -->
        <div class="alert alert-info" role="alert">
            This is your dedicated user dashboard. You can access various services from the sidebar.
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/user_script.js"></script> --> 
    <script>
        // Placeholder for actual functionality for non-navigation items if needed in future
        document.getElementById("chooseCountry")?.addEventListener("click", function(event) {
            event.preventDefault();
            alert("Functionality for Choose Country"); 
        });
        document.getElementById("switchLanguage")?.addEventListener("click", function(event) {
            event.preventDefault();
            alert("Functionality for Switch Language to Arabic");
        });
    </script>
</body>
</html>
