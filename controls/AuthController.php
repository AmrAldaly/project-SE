<?php
require_once '../../models/user.php';
require_once __DIR__ . "/DBController.php";
class AuthController
{
    protected $db;

    public function login($user)
    {
        $this->db=new DBController();

        if ($this->db->openConnection())
        {
            $query="select *  from users where email ='$user->email' and password ='$user->password'";
            if ($this->db->select($query)===false)
            {
               echo " Error in query";
               return false;
            }
            else {
            if (count($this->db->select($query))==0)

                {
                session_start();
                $_SESSION["errmsg"]= " Wrong email or password";
                return false;
                }

                else 
                {

                    session_start();
                    $_SESSION["userId"]=$this->db->select($query)[0]["id"];
                    $_SESSION["userName"]=$this->db->select($query)[0]["first_name"];
                    $_SESSION["userRole"]=$this->db->select($query)[0]["role"];
                    $_SESSION["userLastName"]=$this->db->select($query)[0]["last_name"];
                    $_SESSION["userEmail"]=$this->db->select($query)[0]["email"];
                    $_SESSION["userPhone"]=$this->db->select($query)[0]["phone"];
                    $_SESSION["userAddress"]=$this->db->select($query)[0]["address"];
                    return true;

                }
        }
    }
        else 
        {
            echo " Error in database connection";
            return false;
        }
    }


    public function register(User $user)
    {
        $this->db=new DBController();

        if ($this->db->openConnection())
        {
            $query="insert into users values ('','$user->first_name','$user->last_name','$user->role','$user->email','$user->password','$user->address','$user->phone')";
            if ($this->db->insert($query)===false)
            {
               $_SESSION["errmsg"]=" Something went wrong ... try again";
               return false;
            }
            else
             {
               
                    session_start();
                    $_SESSION["userId"]=$this->db->insert($query);
                    $_SESSION["userName"]=$user->first_name;
                    $_SESSION["userRole"]=$user->role;
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