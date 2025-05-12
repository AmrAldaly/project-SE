<?php 
require_once __DIR__ . "/DBController.php";
require_once '../../models/user.php';



class viewAppController{
    protected $db;

    
    public function getAppointments($patient_id) {
        $this->db = new DBController();
       if ($this->db->openConnection()){
        $query="SELECT a.appointment_id, a.appointment_date, a.appointment_time, a.reason, a.status, 
       CONCAT(u.first_name, ' ', u.last_name) AS doctor_name
FROM appointments AS a
LEFT JOIN users AS u ON a.doctor_id = u.id
WHERE u.role = 'doctor' AND a.user_id = $patient_id
ORDER BY a.appointment_date, a.appointment_time";

                  return $this->db->select($query);

       }
        
    }
}


































?>