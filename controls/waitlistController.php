<?php 
require_once __DIR__ . "/DBController.php";



class waitlistController{
    protected $db;

    public function join_waitlist($waitlist){
          $this->db=new DBController();

        if ($this->db->openConnection())
        {
            $query="INSERT INTO waitlists (patient_id, doctor_id, patient_name, start_date, end_date, reason, status)  VALUES ('$waitlist->patient_id','$waitlist->doctor_id','$waitlist->patient_name' ,'$waitlist->start_date', '$waitlist->end_date', '$waitlist->reason','Pending')";
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