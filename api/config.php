<?php
	/*
	==Info==
	Fresh install? You mainly have to edit config.php, just follow the instructions in the README file.
	Feel free to fork this project!
	*/
	$config = array (
		"mysql" => array (
			"hostname" => "",
			"username" => "",
			"password" => "",
			"database" => "",
			"ban_table" => array (
				"name" 				=> "",
				"ip_format" 		=> "", // long | ip
				"field_ip"			=> "",
				"field_expires"		=> "",
				"field_permanent" 	=> ""
			)
		),
	);
?>
