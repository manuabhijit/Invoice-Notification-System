<?php

    session_start();

    //Incase no one is logged in
    if(!isset($_SESSION['register']))
    {
        $header="Location: logout.php";
        header($header);
    }

    $sender=$_SESSION['register'];

    //database Connectiviy
    $host="localhost";  $username="root";
    $password="";    $database="invoice";
    mysql_connect($host,$username,$password);
    @mysql_select_db($database) or die( "Unable to select database");

    // Variable defined
    $status = "fail"; // Status to Update database
    $item=array();  $cost=array();  $discount=array();  $quantity=array();
    $cost_temp=array(); $cost_temp=array(); $discount_temp=array(); $quantity_temp=array();
    $null_flag=0;   $tax_percent=10;    $total_cost=0;
    $recieve="";

    //Data validation
    if( isset($_POST['reciever']) &&
        isset($_POST['item_1']) && isset($_POST['cost_1']) && isset($_POST['discount_1']) && isset($_POST['quantity_1']))
    {
        $reciever=$_POST['reciever'];
        for($loop=0;$loop<=5;$loop++)
        {
            $item[$loop]="null";    $cost[$loop]=0;     $discount[$loop]=0;     $quantity[$loop]=0;
            if($loop==0) continue;

            $item_str="item_$loop";
            $item_cost="cost_$loop";
            $item_discount="discount_$loop";
            $item_quantity="quantity_$loop";

            if(isset($_POST[$item_str]) && isset($_POST[$item_cost]) && isset($_POST[$item_discount]) && isset($_POST[$item_quantity]))
            {
                //echo $loop;
                $item[$loop]=$_POST[$item_str];
                $cost_temp[$loop]=$_POST[$item_cost];
                $discount_temp[$loop]=$_POST[$item_discount];
                $quantity_temp[$loop]=$_POST[$item_quantity];

                if ($null_flag==0 && is_numeric($cost_temp[$loop]) && is_numeric($discount_temp[$loop]) && is_numeric($quantity_temp[$loop]) && strlen($item[$loop])!=0 )
                {
                    $cost[$loop]= (float)$cost_temp[$loop];
                    $discount[$loop] = (float)$discount_temp[$loop];
                    $quantity[$loop] = (float)$quantity_temp[$loop];
                }
                else
                {
                    $null_flag=1;
                    $item[$loop]="null";    $cost[$loop]=0;     $discount[$loop]=0; $quantity[$loop]=0;
                }
            }
        }


        if($item[1]!="null") $status="pass";
        if(filter_var($reciever, FILTER_VALIDATE_EMAIL))
        {
            $reciever_name=NULL;
            $query="select * from users where `email`= '$reciever'";
            $run=mysql_query($query);
            while ($row=mysql_fetch_array($run)) {
                $reciever_name=$row[2];
            }

            if($reciever_name==NULL)
            {
                $status="fail";
                echo "The Person is not registed with us";
            }
        }
        else{
            echo "Invalid Email ID";
            $status="fail";
        }

        // Cost Calculations
        for($loop=1; $loop<=5; $loop++)
        {
            //echo $item[$loop] . "</br>";
            //echo $cost[$loop] . "</br>";
            //echo $discount[$loop] . "</br>";
            //echo $quantity[$loop] . "</br>";
            $total_cost += $cost[$loop]*$quantity[$loop]*(1-$discount[$loop]/100);
        }
        //echo $status;
    }

    // When all the conditions are varified and data base can be updated
    if($status=="pass")
    {

        $result = mysql_query("SELECT * FROM documents");
		$count1 = mysql_num_rows($result)+1;

        echo "invoice Sent";
			if($count1<10)
				$pfid='My_Comp_inv'."00".$count1;
			else if($count1<100)
				$pfid='My_Comp_inv'."0".$count1;
			else
				$pfid='My_Comp_inv'.$count1;

        // Insert  in database
        mysql_query	("
                    INSERT INTO documents
                    (   id,
                        s_email, r_email,
                        r1,r1_c,d1,q1,
                        r2,r2_c,d2,q2,
                        r3,r3_c,d3,q3,
                        r4,r4_c,d4,q4,
                        r5,r5_c,d5,q5,
                        total_cost, tax_percent,
                        notification, notificaton_type, notification_message)
                    VALUES
                    (
                        '".$pfid."',
                        '".$sender."','".$reciever."',
                        '".$item[1]."','".$cost[1]."','".$discount[1]."','".$quantity[1]."',
                        '".$item[2]."','".$cost[2]."','".$discount[2]."','".$quantity[2]."',
                        '".$item[3]."','".$cost[3]."','".$discount[3]."','".$quantity[3]."',
                        '".$item[4]."','".$cost[4]."','".$discount[4]."','".$quantity[4]."',
                        '".$item[5]."','".$cost[5]."','".$discount[5]."','".$quantity[5]."',
                        '".$total_cost."','".$tax_percent."',
                        'reciever','active','no_message'
                    )
                    ") or die (mysql_error());
    }





 ?>
