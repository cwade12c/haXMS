
<?php

##<!-- Info -->##
DEFINE("SITE","haXMS"); #Site title. -> haXMS default

##<!-- Paths -->##
DEFINE("PATH","sys"); #haXMS(Handler) Directory -> sys default
DEFINE("HOME","https://localhost"); #Home Page -> localhost default
DEFINE("AUTH","https://localhost/login.php"); #Login Page -> login.php default

##<!-- Database -->##
DEFINE("HOST","127.0.0.1:3306"); #Database Host -> localhost default
DEFINE("DB"  ,"mysite"); #Database Name -> hxm_site default
DEFINE("USER","root"); #Database User -> hxm_wade default
DEFINE("PASS",""); #Database Pass -> hXm_!@l5 default

##<!-- Settings -->##
DEFINE("LISTEN",TRUE); #Turn on monitor mode? TRUE=On , FALSE=Off
DEFINE("IDX","login"); #Default Module to load if monitor mode is enabled.
DEFINE("PKEY","abcdef"); #Register module password key

##<!-- Third Party Modules -->##
DEFINE("REC_PUB","x"); #reCAPTCHA Public Key

?>
