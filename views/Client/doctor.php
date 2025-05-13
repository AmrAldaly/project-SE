<?php   
session_start();
if (!isset($_SESSION['userRole']))
{
    header("location: ../Auth/login.php");
}
else 
{
    if ($_SESSION['userRole']!="doctor"){
        header("location: ../Auth/login.php");
    }
}




echo " This is doctor page";

?>