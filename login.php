<?php

//require_once('engine.php');














require('hx_config.php');
require(PATH . '/modules/login/classes/login.class.php');
fetchtemplate();

$login = new Login();

if(isset($_POST["login"]))
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$han = $login->doLogin($username,$password);
	if($han == true)
	{
		echo 'Login successful!';
	}
	else
	{
		echo 'Login invalid!';
	}
}



?>