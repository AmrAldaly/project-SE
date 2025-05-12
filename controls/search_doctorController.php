<?php 
require_once __DIR__ . "/DBController.php";
require_once '../../models/user.php';



class search_doctorController{
    protected $db;

    
  public function searchDoctors($name, $specialty, $location) {
    $this->db= new DBController();
    if ($this->db->openConnection()){
    try {
        $query = "SELECT u.id, u.first_name, u.last_name, d.specialty, d.clinic_address 
                  FROM users AS u
                  JOIN doctors AS d ON u.id = d.user_id
                  WHERE u.role = 'doctor'";

        $conditions = [];

        if (!empty($name)) {
            $conditions[] = "(u.first_name LIKE '$name' OR u.last_name LIKE '$name')";
        }
        if (!empty($specialty)) {
            $conditions[] = "d.specialty LIKE '$specialty'";
        }
        if (!empty($location)) {
            $conditions[] = "d.clinic_address LIKE '$location'";
        }

        if ($conditions) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        return $this->db->select($query);
    } catch (PDOException $e) {
        echo "Error searching doctors: " . $e->getMessage();
        return [];
    }
}
 else 
        {
            $_SESSION["errmsg"]= " Error in database connection";
            return false;
        }
}
}

?>