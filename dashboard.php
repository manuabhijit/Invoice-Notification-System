<?php

    session_start();

    // Database connectivity.
    require('generic_php/db_connect.php');
    $conn= new db_connector;
    $conn->coonect_now();

    // If no pne is logged in
    if(!isset($_SESSION['register']))
    {
        $header="Location: logout.php";
        header($header);
    }


    // Get Details of logged in user
    $user_email=$_SESSION['register'];
    $query="select * from users where `email`= '$user_email'";
    $run=mysql_query($query);

    while ($row=mysql_fetch_array($run)) {
        $user_name=$row[2];     $user_address=$row[3];
    }

    //Count number of notifications
    $notification_count=0;
    $query="select * from documents where r_email ='".$user_email."' and notificaton_type='active'";
    $run=mysql_query($query);
    while ($row=mysql_fetch_array($run)) {
        $notification_count++;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/materialize.css">
		<link rel="stylesheet" href="css/materialize.min.css">

		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
		<script src="js/materialize.min.js" type="text/javascript"></script>
        <script src="js/clipboard.min.js" type="text/javascript"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
        <title>Dashboard</title>
    </head>
    <body>
        <header>
            <nav>
                <div class="nav-wrapper grey darken-4">
                  <a href="#" class="brand-logo"><i class="material-icons"></i>Invoice Portal</a>
                  <div style="float:right; padding-top: 1px; padding-right: 10px;"><a href="logout.php" style="text-transform: capitalize" class="waves-effect waves-light btn red darken-3">Logout</a></div>
                </div>
              </nav>
        </header>

        <main>
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div>
                            <div class="card" style="overflow-y:scroll; height:400px;">
                                <div class="card-content">
                                    <center><h6><b>Recieved Invoives
                                    <?php
                                        if($notification_count!=0)
                                            echo "<span class=\"new badge\">$notification_count</span>";
                                    ?>
                                    </b></h6></center>

                                    <table class="centered">
                                        <thead>
                                            <tr>
                                              <th>Issue Timestamp</th>
                                              <th>ID</th>
                                              <th>Sender</th>
                                              <th>Summary</th>
                                              <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>


                                            <?php

                                            // Shows up all the invoices for the logged in user on which he has to take action
                                            $query="select * from documents where r_email ='".$user_email."' and (notificaton_type='active' or notificaton_type='passive')  ORDER BY notificaton_type";
                                            $run=mysql_query($query);
                                            while ($row=mysql_fetch_array($run)) {
                                            ?>
                                            <tr>
                                                <?php
                                                    echo "<td>$row[1]</td>";
                                                    echo "<td>";
                                                    if($row[17]=="active")
                                                        echo "<a class=\"collection-item\"><span class=\"new badge\"></span></a>";
                                                    echo "<a href=\"http://localhost/invoice/pdf/index.php?invoiceid=$row[0]\" target=\"_target\"> $row[0] </a></td>";
                                                    echo "<td>$row[2]</td>";
                                                    echo "<td>$row[14]</td>";
                                                    echo "<td id=\"actor_$row[0]\">
                                                        <a id=\"action_$row[0]\" class=\"waves-effect waves-light btn\" href=\"#modal$row[0]\">Take Action</a></td> ";

                                                    echo "<div id=\"modal$row[0]\" class=\"modal\">
                                                        <div class=\"modal-content\">
                                                          <h4 style = \"font-size: 25px;\">ID: $row[0]</h4>

                                                          <textarea maxlength=\"100\"id=\"message_$row[0]\" class=\"materialize-textarea\" >Message to Sender: </textarea>
                                                        </div>
                                                        <div class=\"modal-footer\">
                                                          <a href=\"#!\" onclick=\"accept_deny('$row[0]','a')\" class=\"modal-action modal-close waves-effect waves-green btn\">Agree</a>
                                                          &nbsp
                                                          <a href=\"#!\" onclick=\"accept_deny('$row[0]','d')\"class=\"modal-action modal-close waves-effect waves-red btn\" >Deny</a>
                                                        </div>
                                                      </div>";

                                            }

                                            // Sets the notification shown to passive
                                            $sql = "UPDATE documents SET notificaton_type='passive' WHERE r_email ='".$user_email."' and notificaton_type='active'";
                                            $run=mysql_query($sql);

                                            ?>



                                            <script>
                                                $(document).ready(function(){
                                                    $('.modal').modal();
                                                });

											</script>
                                            </tr>

                                            <?php
                                            // Shows up all the invoices for the logged in user on which he has taken action
                                            $query="select * from documents where r_email ='".$user_email."' and (notificaton_type<>'active' and notificaton_type<>'passive')";
                                            $run=mysql_query($query);
                                            while ($row=mysql_fetch_array($run)) {
                                                ?>


                                            <tbody>
                                                <tr>
                                                    <?php
                                                        echo "<td>$row[1]</td>";
                                                        echo "<td><a href=\"http://localhost/invoice/pdf/index.php?invoiceid=$row[0]\" target=\"_target\"> $row[0] </a></td>";
                                                        echo "<td>$row[3]</td>";
                                                        echo "<td>$row[14]</td>";

                                                        if($row[17]=="accepted" || $row[17]=="rejected")
                                                        {

                                                            echo "<td><a href=\"#modal_message_$row[0]\"> $row[17]</a></td>";
                                                            echo "\n<div id=\"modal_message_$row[0]\" class=\"modal\">
                                                                    <div class=\"modal-content\">
                                                                      <h4 style = \"font-size: 25px;\">ID: $row[0]</h4>
                                                                      <p>Message: $row[18] </p>
                                                                    </div>
                                                                    <div class=\"modal-footer\">
                                                                      <a class=\"modal-action modal-close waves-effect waves-green btn-flat\">Close</a>
                                                                    </div>
                                                                  </div>";
                                                        }


                                                }?>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		    <div class="row">
                <!-- Form Starts here -->
                <div class="col s6">
                    <div class="row">
                        <div>
                            <div class="card">
                                <div class="card-content">
                                    <center><h6><b>Create Invoice</b></h6></center>
                                    <div class="row">
                                          <div class="row">
                                            <div class="input-field col s12">
                                              <input disabled value="<?php echo $_SESSION['register']; ?>" id="disabled" type="email" class="validate" id="sender">
                                              <label for="disabled">Sender</label>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col s12">
                                              Reciever:
                                              <div class="input-field inline">
                                                <input  type="email" value="user_three@gmail.com" class="validate" id="reciever">
                                                <label for="email" data-error="wrong" data-success="right">Email</label>
                                              </div>
                                            </div>
                                          </div>


                                        <?php

                                            //shows fields for 5 items in the form
                                             for($loop=1;$loop<=5;$loop++)
                                             {
                                        ?>

                                          <div class="row">
                                            <div class="input-field col s12">
                                                <input  value="Item_name" type="text" class="validate" id="item_<?php echo $loop ?>" <?php if($loop == 1) echo "required"; ?>>
                                                <label for="itemname<?php echo $loop ?>">Name of Item <?php echo $loop ?></label>
                                            </div>
                                            <div class="input-field col s6">
                                              <input pattern="^(0|[1-9][0-9]*)$" value="10" type="text" class="validate" id="cost_<?php echo $loop ?>" <?php if($loop == 1) echo "required"; ?>>
                                              <label for="cost<?php echo $loop ?>"  >Cost</label>
                                            </div>
                                            <div class="input-field col s3">
                                              <input  pattern="^(0|[1-9][0-9]*)$" value="14" type="text" class="validate" id="discount_<?php echo $loop ?>" <?php if($loop == 1) echo "required"; ?>>
                                              <label for="discount<?php echo $loop ?>"  >Discount %</label>
                                            </div>
                                            <div class="input-field col s3">
                                              <input  pattern="^(0|[1-9][0-9]*)$" value="6" type="text" class="validate" id="quantity_<?php echo $loop ?>" <?php if($loop == 1) echo "required"; ?>>
                                              <label for="quantity<?php echo $loop ?>"  >quantity</label>
                                            </div>
                                          </div>

                                        <?php } ?>

                                            <a class="waves-effect waves-light btn" onclick="sf();"><i class="material-icons left"></i>Send Invoice</a>


                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- Ends Starts here -->

                <!-- Sent table Starts here -->
                <div class="col s6">
                    <div class="row">
                        <div>
                            <div class="card" style="overflow-y:scroll; height:400px;">
                                <div class="card-content">
                                    <center><h6><b>Sent Invoices</b></h6></center>
                                    <table class="centered">
                                        <thead>
                                            <tr>
                                              <th>Issue Timestamp</th>
                                              <th>ID</th>
                                              <th>Reciever</th>
                                              <th>Total Amount</th>
                                              <th>Status</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $query="select * from documents where s_email ='".$user_email."'";
                                        $run=mysql_query($query);
                                        while ($row=mysql_fetch_array($run)) {
                                            ?>


                                        <tbody>
                                            <tr>
                                                <?php
                                                    echo "<td>$row[1]</td>";
                                                    echo "<td><a href=\"http://localhost/invoice/pdf/index.php?invoiceid=$row[0]\" target=\"_target\"> $row[0] </a></td>";
                                                    echo "<td>$row[3]</td>";
                                                    echo "<td>$row[14]</td>";

                                                    if($row[17]=="accepted" || $row[17]=="rejected")
                                                    {

                                                        echo "<td><a href=\"#modal_message_$row[0]\"> $row[17]</a></td>";
                                                        echo "\n<div id=\"modal_message_$row[0]\" class=\"modal\">
                                                                <div class=\"modal-content\">
                                                                  <h4 style = \"font-size: 25px;\">ID: $row[0]</h4>
                                                                  <p>Message: $row[18] </p>
                                                                </div>
                                                                <div class=\"modal-footer\">
                                                                  <a class=\"modal-action modal-close waves-effect waves-green btn-flat\">Close</a>
                                                                </div>
                                                              </div>";
                                                    }
                                                    else
                                                        echo "<td>pending</td>";


                                            }?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sent table Ends here -->
            </div>
        </main>
    </body>
    <script src="js/dashboard.js" type="text/javascript"></script>
</html>
