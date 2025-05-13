<?php
require_once '../../controls/order_medicineController.php';
require_once '../../models/order_medicine.php';


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




$controller = new order_medicineController();
$success = "";
$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (!empty($_POST["medication_name"]) && !empty($_POST["quantity"])&& !empty($_POST["prescription_type"])) {
    $order=new order_medicine();
    $order->patient_id = $_SESSION['userId'];
    $order->patient_name=$_POST['patient_name'];
    $order->medication_name = $_POST['medication_name'];
    $order->dosage = $_POST['dosage'];
    $order->quantity = $_POST['quantity'];
    $order->prescription_type=$_POST['prescription_type'];
    $order->pharmacy=$_POST['pharmacy'];
    $order->notes=$_POST['notes'];


    if ($controller->order_medicine($order)) {
        $success = "Order Medicine request submitted successfully!";
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
    <title>Order Medicine - Clinic Management System</title>
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
        <h1 class="h2 mb-4">Order Medicine</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Request Prescription Refill or New Medication</h5>
                <p class="card-text">Please fill out the form below to request medicine. This is a placeholder page and the form is not functional yet. For urgent requests, please contact your doctor directly.</p>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="patientNameMed" class="form-label">Patient Name</label>
                        <input type="text" name="patient_name" class="form-control" id="patientNameMed" placeholder="Enter patient's full name" value="<?php echo $_SESSION['userName']." ". $_SESSION['userLastName'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="medicationName" class="form-label">Medication Name</label>
                        <input type="text" name="medication_name" class="form-control" id="medicationName" placeholder="e.g., Amoxicillin 250mg">
                    </div>
                    <div class="mb-3">
                        <label for="dosage" class="form-label">Dosage (if known)</label>
                        <input type="text" name="dosage" class="form-control" id="dosage" placeholder="e.g., 1 tablet, 3 times a day">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="e.g., 30">
                    </div>
                    <div class="mb-3">
                        <label for="prescriptionType" class="form-label">Request Type</label>
                        <select name="prescription_type" class="form-select" id="prescriptionType">
                            <option selected>Choose...</option>
                            <option value="refill">Prescription Refill</option>
                            <option value="new">New Prescription (requires doctor approval)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pharmacyPreference" class="form-label">Preferred Pharmacy (Optional)</label>
                        <input type="text" name="pharmacy" class="form-control" id="pharmacyPreference" placeholder="e.g., Local Pharmacy, 123 Drug St.">
                    </div>
                    <div class="mb-3">
                        <label for="additionalNotesMed" class="form-label">Additional Notes</label>
                        <textarea name="notes" class="form-control" id="additionalNotesMed" rows="3" placeholder="Any specific instructions or comments"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Medicine Request</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/order_medicine_script.js"></script> -->
</body>
</html>
