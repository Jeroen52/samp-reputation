<?php
	/*
	==Info==
	Fresh install? You mainly have to edit config.php, just follow the instructions in the README file.
	Feel free to fork this project!
	*/
	require_once(dirname(__FILE__)."/config.php");
	
	if(isset($_GET["lookup"]) && isset($_GET["ip"]))
	{
		if(strlen($_GET["ip"]) > 15)
			die("0"); //Invalid IP address, it is too long.
	
		$db = @new mysqli($config["mysql"]["hostname"], $config["mysql"]["username"], $config["mysql"]["password"], $config["mysql"]["database"]); //You can edit the database info in the config.
		
		if($db->connect_error)
			die("0"); //Could not connect to the database.
			
		$ip = $db->escape_string($_GET["ip"]);
		
		// Add support for both dot separated and long ips
		if(is_numeric($ip))
		{
			if($config["mysql"]["ban_table"]["ip_format"] == "long")
				$check_ip_q = "SELECT `{$config["mysql"]["ban_table"]["field_permanent"]}` FROM `{$config["mysql"]["ban_table"]["name"]}` WHERE `{$config["mysql"]["ban_table"]["field_ip"]}` = {$ip}";
			else
				$check_ip_q = "SELECT `{$config["mysql"]["ban_table"]["field_permanent"]}` FROM `{$config["mysql"]["ban_table"]["name"]}` WHERE `{$config["mysql"]["ban_table"]["field_ip"]}` = INET_NTOA({$ip})";
		}
		else
		{
			if(filter_var($ip, FILTER_VALIDATE_IP))
			{
				if($config["mysql"]["ban_table"]["ip_format"] == "long")
					$check_ip_q = "SELECT `{$config["mysql"]["ban_table"]["field_permanent"]}` FROM `{$config["mysql"]["ban_table"]["name"]}` WHERE `{$config["mysql"]["ban_table"]["field_ip"]}` = INET_ATON('{$ip}')";
				else
					$check_ip_q = "SELECT `{$config["mysql"]["ban_table"]["field_permanent"]}` FROM `{$config["mysql"]["ban_table"]["name"]}` WHERE `{$config["mysql"]["ban_table"]["field_ip"]}` = '{$ip}'";
			}
			else
				echo "0";
		}
		
		$check_ip_q .= " AND (`{$config["mysql"]["ban_table"]["field_permanent"]}` = 1 OR `{$config["mysql"]["ban_table"]["field_expires"]}` > NOW()) LIMIT 1";
		
		$check_ip_r = $db->query($check_ip_q);
		
		if($check_ip_r->num_rows)
		{
			$check_ip_a = $check_ip_r->fetch_assoc();
			
			if($check_ip_a[$config["mysql"]["ban_table"]["field_permanent"]])
				echo "3"; //Permabannned
			else
				echo "2"; //Tempbanned
		}
		else
			echo "1"; //Not banned
	}
	else
		echo "0";
?>
