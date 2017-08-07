<?php
    session_start();

    //Incase no one is logged in
    if(!isset($_SESSION['register']))
    {
        $header="Location: logout.php";
        header($header);
    }
    
    // Checks if data is recieved fro GET METHOD
    if(isset($_GET['act']) && isset($_GET['msg']) && isset($_GET['id']))
    {
        // Database connectivity.
        require('generic_php/db_connect.php');
        $conn= new db_connector;
        $conn->coonect_now();


        if($_GET['act']=='a')
        {
            $status="accepted";
        }
        else {
            $status="rejected";
        }
        $user_email=$_SESSION['register'];

        // Datbase updation
        $sql = "UPDATE documents SET notification='sender', notificaton_type='".$status."', notification_message='".$_GET['msg']."' WHERE id ='".$_GET['id']."'";

        $run=mysql_query($sql);
        echo $status;
    }




?>
