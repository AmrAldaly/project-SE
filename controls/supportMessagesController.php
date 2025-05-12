<?php
require_once __DIR__ . "/DBController.php";

class  supportMessagesController{
    protected $db;

    
    public function leaveMessage($msg){
        $this->db = new DBController();
       if ($this->db->openConnection()){
        $query="INSERT INTO support_messages (name, email, subject, message) 
                  VALUES ('$msg->name', '$msg->email', '$msg->subject', '$msg->message')";

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