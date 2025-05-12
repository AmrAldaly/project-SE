<?php
require_once __DIR__ . "/DBController.php";

class viewDoctorProfileController{
    protected $db;

    
    public function getDoctorProfile($doctor_id) {
        $this->db = new DBController();
       if ($this->db->openConnection()){
        $query="SELECT u.id, u.first_name, u.last_name, u.email, u.phone, d.specialty, d.clinic_address, d.available 
                  FROM users AS u
                  JOIN doctors AS d ON u.id = d.user_id
                  WHERE u.id = '$doctor_id'";

                  return $this->db->select($query);

       }
       else{
        $_SESSION['errmsg']=" Error in database connection";
       }
        
    }



    public function getDoctorReviews($doctor_id) {
    try {
        $query = "SELECT r.rating, r.comment, r.anonymous, r.created_at, u.first_name, u.last_name
                  FROM reviews AS r
                  JOIN users AS u ON r.patient_id = u.id
                  WHERE r.doctor_id = '$doctor_id'
                  ORDER BY r.created_at DESC";
      
        return $this->db->select($query);
    } catch (PDOException $e) {
        echo "Error fetching reviews: " . $e->getMessage();
        return [];
    }
}



    
}


?>