<?php

class Dbh
{

    private $host = "localhost";
    private $username = "root";
    private $pwd = "";
    private $dbname = "dlogic";


    public function connection()
    {

        $connection = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->username, $this->pwd);
        if (!$connection) {
            die("connection failied:");
        }else{
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $connection;
        }
    }
}
