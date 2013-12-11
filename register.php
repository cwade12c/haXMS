<?php

require('hx_config.php');
require(PATH . '/modules/register/classes/register.class.php');
fetchTemplate();

$reg = new Register();

if(isset($_POST["register"]))
{
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];

	$reg->doRegister($email,$username,$password);
}

if(isset($_POST["validate"]))
{
	$username = $_POST["username"];
	$vkey = $_POST["vkey"];
	$reg->doValidate($username,$vkey);
}

?>