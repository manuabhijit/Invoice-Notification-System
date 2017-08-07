<?php
// logs you out
	session_start();

	unset($_SESSION['register']);

	session_destroy();
	$header="Location: index.php";
	header($header);

?>
