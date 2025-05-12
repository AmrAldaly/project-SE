<?php 
require_once __DIR__ . "/DBController.php";



class  order_medicineController{
    protected $db;

    public function order_medicine($order){
          $this->db=new DBController();

        if ($this->db->openConnection())
        {
            $query="INSERT INTO medicine_orders (patient_id, patient_name, medication_name, dosage, quantity, prescription_type, pharmacy, notes, status) 
                  VALUES ('$order->patient_id', '$order->patient_name', '$order->medication_name', '$order->dosage', '$order->quantity', '$order->prescription_type', '$order->pharmacy', '$order->notes', 'Pending')";

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


?>