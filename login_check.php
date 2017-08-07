<?php

    // I person is already logged In
    session_start();
    if(isset($_SESSION['register']))
    {
        $header="Location: dashboard.php";
		header($header);
    }

    $status="fail"; //Marks the success and failure of login event

    // Database connectivity.
    require('generic_php/db_connect.php');
    $conn= new db_connector;
    $conn->coonect_now();

    //if username and password are recieved using post method.
    if(isset($_GET['username']) && isset($_GET['userpass']))
    {
        $user_name=$_GET['username'];
        $pass_word=$_GET['userpass'];

        //BCRYPT is applied to generate hash key
        $options = [ 'cost' => 12, 'salt' => "heykitheykitheykitheykit",];
        $hash_pass = trim(password_hash($pass_word, PASSWORD_BCRYPT, $options)."\n");

        //Filters invalid emails and length zero password attempts
        if (filter_var($user_name, FILTER_VALIDATE_EMAIL) && strlen($pass_word)!=0)
        {
            //Checks if access has to be granted.
            $query="select * from users where `email`= '$user_name'";
			$run=mysql_query($query);
            while ($row=mysql_fetch_array($run))
			{
                if(trim($row[1])==trim($hash_pass))
                {
                    $status="pass"; // Sets event status to pass
                    break;
                }
            }
        }
    }
    else {
        // If variables are not set it redirects to index.php
        $header="Location: index.php";
		header($header);
    }

    // If event status is pass the SESSION variable is initialized
    if($status!="pass")
    {
        echo "do not login";
    }
    else {
        $_SESSION['register']=$user_name;
        echo "login";
    }

    echo $status;


?>
