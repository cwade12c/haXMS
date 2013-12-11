<?php

#####################
/*
 index() wrapper
 Engine->Module_Handling 

 @author     cwade12c
 @copyright  HaxMe
 @package    haXMS
 @link       https://haxme.org/haxms
 @version    1.0.0 Beta (Pre-Release)
*/
#####################

DEFINE( 'haXMS_HERE', '' ); //Grant access to engine.php
require_once( './engine.php' );

/*Start Block*/
        Engine::init(); //Initialize
	$engine = new Engine(); //Create object

        /*Everything below is e.g. of manual handling*/
	#$mod = $engine->loadMod('login','login.class.php','Login');
	#$mod->fetchtemplate('login','index.php');

	#$mod->news(10); //Load the latest 10 articles
/*End Block*/

?>


 
 
