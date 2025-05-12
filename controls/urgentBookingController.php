<?php 
require_once __DIR__ . "/DBController.php";



class UrgentBookingController{
    protected $db;

    public function addUrgentBooking($urgent){
          $this->db=new DBController();

        if ($this->db->openConnection())
        {
            $query="INSERT INTO urgent_bookings (patient_id, patient_name, phone, reason, time_slot) VALUES ('$urgent->patient_id','$urgent->patient_name', '$urgent->phone', '$urgent->reason', '$urgent->time_slot')";
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

    
 
    
}
