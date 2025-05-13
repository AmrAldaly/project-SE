<?php
require_once '../../controls/search_doctorController.php';


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




$controller = new search_doctorController();
$results = [];
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['doctor_name'];
    $specialty = $_POST['specialty'];
    $location = $_POST['location'];

    $results = $controller->searchDoctors($name, $specialty, $location);
}





?>












<!DOCTYPE html>
<html>
<head>
    <title>Search Doctors - Clinic Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>

       <?php include '../Client/navbar.php'; ?>
    
   <?php include '../Client/sidebar.php'; ?>



<div class="container mt-5">
    <h2>Search for Doctors</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="doctor_name" class="form-label">Doctor's Name</label>
                        <input type="text" name="doctor_name" class="form-control" placeholder="e.g., Dr. John Doe">
                    </div>
                    <div class="col-md-4">
                        <label for="specialty" class="form-label">Specialty</label>
                        <select name="specialty" class="form-select">
                            <option value="">Choose...</option>
                            <option value="Cardiology">Cardiology</option>
                            <option value="Dermatology">Dermatology</option>
                            <option value="Pediatrics">Pediatrics</option>
                            <option value="General Medicine">General Medicine</option>
                            <option value="Neurology">Neurology</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g., City or Zip Code">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Search Doctors</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Search Results</h5>
            <?php if (!empty($results)): ?>
                <div class="list-group">
                    <?php foreach ($results as $doctor): ?>
                    <a href="user_view_doctor_profile.php?id=<?php echo $doctor['id']; ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <h5><?php echo $doctor['first_name'] . ' ' . $doctor['last_name']; ?></h5>
                                <span><?php echo $doctor['specialty']; ?></span>
                            </div>
                            <p><?php echo $doctor['clinic_address']; ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No doctors found matching the criteria.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>