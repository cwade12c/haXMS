<?php

#This file is not required.
#An example to save you lines of code.

require('hx_config.php');
require(PATH . '/modules/login/classes/login.class.php');

$login = new Login();
$login->chkLogin();

?>