<?php
require_once __DIR__ . "/DBController.php";


class BookAppointmentController {
    protected $db;


    public function bookAppointment($appointment) {
        $this->db = new DBController();
        if ($this->db->openConnection()){
        $query = "INSERT INTO appointments (patient_name, user_id, doctor_id, appointment_date, appointment_time, reason) 
                  VALUES ('$appointment->patient_name','$appointment->user_id','$appointment->doctor_id ',' $appointment->appointment_date','$appointment->appointment_time',' $appointment->reason')";

        if ($this->db->insert($query)===false){
            $_SESSION['errmsg']=" Something went wrong ...try again";
            return false;
        }
        else
        {
            $appointment->appointment_id=$this->db->insert($query);
            return true;
        }
    }
    else
     {
        echo " Error in database connection";
    }
}

  public function getdoctors()
  {
    $this->db = new DBController();
    if ($this->db->openConnection()){
    $query = "SELECT id,first_name,last_name FROM users WHERE role = 'doctor'";
    return $this->db->select($query);
    }

else
 {
    echo " Error in database connection";
}
  

  }

public function updateAppointmentStatus($appointment) 
{
    $this->db =new DBController();
    if ($this->db->openConnection()){
    $query = "UPDATE appointments SET status = 'Confirmed' WHERE appointment_id = $appointment->appointment_id";
    }
    if ($this->db->alter($query)===false)
    {
       $_SESSION["errmsg"]=" Something went wrong ... try again";
       return false;
    }
    else
     {
            return true;

     }


}


public function cancel_appointment($appointment_id){
    $this->db=new DBController();

 if ($this->db->openconnection()){
 $query= "UPDATE appointments SET status ='Cancelled' WHERE appointment_id ='$appointment_id'";
 if ($this->db->alter($query)===false){
    $_SESSION["errmsg"]=" Something went wrong ... try again";
    return false;
 }
 else
 {
   return true;
 }
}
}



 public function reschedule($new_appointment){
    $this->db=new DBController();

 if ($this->db->openconnection()){
 $query= "UPDATE appointments SET appointment_date = '$new_appointment->appointment_date', appointment_time = '$new_appointment->appointment_time', status = 'Pending' 
                  WHERE appointment_id = '$new_appointment->appointment_id'";
 if ($this->db->alter($query)===false){
    $_SESSION["errmsg"]=" Something went wrong ... try again";
    return false;
 }
 else
 {
   return true;
 }

}
else {
    echo " Error in database connection";
    return false;
}
}





}








?>