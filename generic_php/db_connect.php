<?php

class db_connector
{
    public $host;
    public $username;
    public $password;
    public $database;



    function coonect_now()
    {
        $this->host="localhost";  $this->username="root";
        $this->password="";    $this->database="invoice";
        mysql_connect($this->host,$this->username,$this->password);
        @mysql_select_db($this->database) or die( "Unable to select database");
    }

}
?>
