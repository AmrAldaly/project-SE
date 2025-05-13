<?php
require_once '../../controls/supportMessagesController.php';
require_once '../../models/support_messages.php';
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


$supportController = new supportMessagesController();
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $msg=new support_messages();
    $msg->name = $_POST['name'];
    $msg->email = $_POST['email'];
    $msg->subject = $_POST['subject'];
    $msg->message = $_POST['message'];

    if ($supportController->leaveMessage($msg)) {
        $success = "Your support message has been submitted successfully!";
    } else {
        $error = "Failed to submit your message. Please try again.";
    }
}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Support - Clinic Management System</title>
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
        <h1 class="h2 mb-4">Contact Support</h1>

         <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Get Help and Support</h5>
                <p class="card-text">If you have any questions or need assistance, please use the form below to contact our support team.</p>
                <form method="POST">
                    <div class="mb-3">
                        <label for="supportFullName" class="form-label">Your Full Name</label>
                        <input type="text" name="name" class="form-control" id="supportFullName" placeholder="Enter your full name" value="<?php echo $_SESSION['userName']." ".$_SESSION['userLastName'] ;?>">
                    </div>
                    <div class="mb-3">
                        <label for="supportEmail" class="form-label">Your Email Address</label>
                        <input type="email" name="email" class="form-control" id="supportEmail" placeholder="Enter your email" value="<?php echo $_SESSION['userEmail'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="supportSubject" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" id="supportSubject" placeholder="Briefly describe your issue">
                    </div>
                    <div class="mb-3">
                        <label for="supportMessage" class="form-label">Message</label>
                        <textarea class="form-control" name="message" id="supportMessage" rows="5" placeholder="Please provide details about your inquiry or issue"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Custom JS (if any specific to this page) -->
    <!-- <script src="js/contact_support_script.js"></script> -->
</body>
</html>
