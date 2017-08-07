<?php

// This script does not allow login page to load when sm1 is already online
	session_start();
	if(isset($_SESSION['register']))
	{
		$header="Location: dashboard.php";
		header($header);
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
		<title>Login Page</title>
	</head>
	<body>
		<header>
            <nav>
                <div class="nav-wrapper grey darken-4">
                  <a href="#" class="brand-logo"><i class="material-icons"></i>Invoice Portal : Login</a>
                </div>
              </nav>
        </header>
		<main>

			<div class="row">
				<div class="col s3">

				</div>
                <div class="col s6">
                    <div class="row">

						<ul class="collapsible" data-collapsible="accordion">
							<!--Login form Starts Here. -->
							<li>
						      <div class="collapsible-header"><i class="material-icons">power_settings_new</i>Login</div>
							  	<div class="collapsible-body row">
								      <div class="row">
								        <div class="input-field col s6">
								          <input value="user_one@gmail.com" placeholder="Enter your Username"  id="login_username" type="email" class="validate">
								          <label for="Username">Username</label>
								        </div>
								        <div class="input-field col s6">
								          <input value="qwertyuiop" placeholder="password" id="login_password" type="password" class="validate">
								          <label for="Password">Password</label>
								        </div>
								      </div>
									  <a class="waves-effect waves-light btn" onclick="login()"><i class="material-icons left"></i>Login</a>

								  </div>
						    </li>
							<!--Login form Ends Here. -->

							<!--SignUp form Starts Here. -->
							<li>
						      <div class="collapsible-header"><i class="material-icons">place</i>Sign Up</div>

						      <div class="collapsible-body">
								  <div class="row">
									    <div class="row">
									        <div class="input-field col s6">
									          <input placeholder="Enter you full name" id="signup_fullname" type="text" class="validate" required>
									          <label for="full_name">Full Name</label>
									        </div>
									        <div class="input-field col s6">

									          <input placeholder="Enter you email" id="signup_email" type="email" class="validate" required>
									          <label for="email">Email</label>
									        </div>
									      </div>
										  <div class="row">
									        <div class="col s12">
									          This is an inline input field:
									          <div class="input-field inline">
									            <input id="signup_password" type="password" minlength="8" class="validate" required>
									            <label for="password" data-error="wrong" data-success="right">Password</label>
									          </div>
									        </div>
									      </div>
										  <?php

										  $address_part = array();
										  $address_part[1]="Address part 1";
										  $address_part[2]="Address part 2";
										  $address_part[3]="City";
										  $address_part[4]="State";
										  $address_part[5]="Country";

										 for($loop=1;$loop<=5; $loop++)
										  {
										      echo "\n<div class= \"row\">";
										      echo   "\n<div class=\"input-field col s12\">";
										      echo     "\n<input minlength=\"1\" id=\"signup_address_$loop\" type=\"text\" class=\"validate\">";
										      echo     "\n<label for=\"address_$loop\">$address_part[$loop] </label>";
										      echo   "\n</div>";
										      echo  "\n</div>";
									  		}
									  ?>
										  <a class="waves-effect waves-light btn" onclick="signup()"><i class="material-icons left"></i>Sign Up</a>



									  </div>

						      </div>
						    </li>
							<!--SignUp form Ends Here. -->
						  </ul>
					</div>
				</div>
				<div class="col s3">

				</div>
			</div>
		</main>

		<footer class="page-footer grey darken-4">
          <div class="footer-copyright">
            <div class="container">
            © 2017 Abhijit Srivastava

            </div>
          </div>

		  <script type="text/javascript" src="js/login_signup.js"></script>

		</footer>
	</body>
</html>
