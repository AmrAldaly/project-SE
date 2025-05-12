<?php 
require_once __DIR__ . "/DBController.php";



class home_visitController{
    protected $db;

    public function order_home_visit($home_visit){
          $this->db=new DBController();

        if ($this->db->openConnection())
        {
            $query="INSERT INTO home_visits (patient_id, patient_name, address, contact, reason, visit_datetime, status) 
                  VALUES ('$home_visit->patient_id', '$home_visit->patient_name', '$home_visit->address', '$home_visit->contact', '$home_visit->reason', '$home_visit->visit_datetime', 'Pending')";
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