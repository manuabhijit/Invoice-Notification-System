<?php

session_start();

// Checks if all the variable are recieved via POST method
if(isset($_GET['fullname']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['address']) )
{

    $fullname = $_GET['fullname'];
    $email = $_GET['email'];
    $u_password = $_GET['password'];
    $address = $_GET['address'];


    // Database connectivity.
    require('generic_php/db_connect.php');
    $conn= new db_connector;
    $conn->coonect_now();

    //BCRYPT is applied to generate hash key
    $options = [ 'cost' => 12, 'salt' => "heykitheykitheykitheykit",];
    $hash_pass = trim(password_hash($u_password, PASSWORD_BCRYPT, $options)."\n");

    //If some one is already logged in
    if(isset($_SESSION['register']))
    {
        echo "login";
    }
    else{

        // Count occurance of email ID
        $query="select * from users where `email`= '$email'";
        $run=mysql_query($query);

        $count_occur=0;

        while ($row=mysql_fetch_array($run))
        {
            $count_occur++;
        }
        if($count_occur!=0) // User already registerd
        {
            echo "already";
        }
        else {
            mysql_query	("
                        INSERT INTO users
                        (   name, email,
                            password, address)
                        VALUES
                        (
                            '".$fullname."',
                            '".$email."','".$hash_pass."',
                            '".$address."'
                        )
                        ") or die (mysql_error());
            echo "successful";
        }
    }




}

?>
