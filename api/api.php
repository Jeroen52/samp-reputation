<?php
	$db = @new mysqli($config["mysql"]["hostname"], $config["mysql"]["hostname"], $config["mysql"]["hostname"], $config["mysql"]["hostname"]);
	
	if($db->connect_error)
		die("Connection to the database could not be established.");
		
?>
