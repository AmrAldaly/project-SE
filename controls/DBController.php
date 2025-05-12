<?php
class DBController
{
    public $dbHost="localhost";
    public $dbUser="root";
    public $dbPassword="";
    public $dbName="mpms";
    public $connection;
    
    
    public function openConnection()
    {
        $this->connection=new mysqli($this->dbHost,$this->dbUser,$this->dbPassword,$this->dbName);
        if ($this->connection->connect_error){
            echo " Error in connection" .$this->connection->connect_error;
            return false;
        }
        else {
            return true;
        }


    }

    public function closeConnection()
    {
        if ($this->connection){
            $this->connection->close();
        }
        else {
            echo " Connection is not openned";
        }


    }

    public function select($qry)
    {
        $result= $this->connection->query($qry);

        if ($result)
        {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            echo " Error: ".mysqli_error($this->connection);
            return false;
        }
    }



    public function insert($qry){
        $result= $this->connection->query($qry);

        if ($result)
        {
            return $this->connection->insert_id;
        }
        else {
            echo " Error: ".mysqli_error($this->connection);
            return false;
        }
    }
    
    public function alter($qry){
        $result= $this->connection->query($qry);

        if ($result)
        {
            return true;
        }
        else {
            echo " Error: ".mysqli_error($this->connection);
            return false;
        }
    }





}



?>