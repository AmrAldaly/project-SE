<?php
require_once '../../models/user.php';
require_once __DIR__ . "/DBController.php";

class ProfileController 
{
    protected $db;

    public function edit($user) {
        $this->db=new DBController();
        if ($this->db->openConnection())
        {
            $query="UPDATE users SET first_name ='$user->first_name',email ='$user->email',address ='$user->address',phone ='$user->phone' WHERE id ='$user->id'";
            if ($this->db->alter($query)===false)
            {
               $_SESSION["errmsg"]=" Something went wrong ... try again";
               return false;
            }
            else
             {
               
                    session_start();
                    $_SESSION["userName"]=$user->first_name;
                    $_SESSION["userPhone"]=$user->phone;
                    $_SESSION["userAddress"]=$user->address;
                    $_SESSION["userEmail"]=$user->email;
                    return true;

             }
        }
    
        else 
        {
            echo " Error in database connection";
            return false;
        }
    }


    

    }










































?>
