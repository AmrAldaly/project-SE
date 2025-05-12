<?php
require_once __DIR__ . "/DBController.php";

class  userVoiceVideoCallController{
    protected $db;

    
    public function scheduleCall($call) {
        $this->db = new DBController();
       if ($this->db->openConnection()){
        $query="INSERT INTO telehealth_calls (doctor_id, patient_id, call_datetime, reason) 
                  VALUES ('$call->doctor_id', '$call->patient_id', '$call->call_datetime', '$call->reason')";

             if ($this->db->insert($query)===false)
            {
               $_SESSION["errmsg"]=" Something went wrong ... try again";
               return false;
            }
            else
             {
                    return true;
                }
        }
    
        else 
        {
            $_SESSION["errmsg"]= " Error in database connection";
            return false;
        }
    }


    public function checkDoctorAvailability($doctor_id){
    $this->db = new DBController();
     if ($this->db->openConnection()){
    $query = "SELECT available FROM doctors WHERE user_id = '$doctor_id'";
    
     return $this->db->select($query);

    }
     else 
        {
            $_SESSION["errmsg"]= " Error in database connection";
            return false;
        }
    
}


}