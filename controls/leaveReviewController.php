<?php
require_once __DIR__ . "/DBController.php";


class leaveReviewController {
    protected $db;


    public function leaveReview($review) {
        $this->db = new DBController();
        if ($this->db->openConnection()){
        $query = "INSERT INTO reviews (doctor_id, patient_id, rating, comment, anonymous) 
                  VALUES ('$review->doctor_id', '$review->patient_id', '$review->rating', '$review->comment', '$review->anonymous')";
        if ($this->db->insert($query)===false){
            $_SESSION['errmsg']=" Something went wrong ...try again";
            return false;
        }
        else
        {
            $review->id=$this->db->insert($query);
            return true;
        }
    }
    else
     {
        echo " Error in database connection";
    }
}


}












?>
