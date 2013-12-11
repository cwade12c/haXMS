<?php

if( !DEFINED('haXMS_HERE') ) { die(); }

if( !isset($_GET['act']) )
{
    handle(IDX);
}
else
{
    handle($_GET['act']);
}

function handle($module)
{
    switch ($module)
    {
        case "login":
	//{		
            $v = Engine::loadmod('login','login.class.php','Login');
            $v->fetchtemplate('login','index.php'); //Module directory, template filename
			
            if( isset($_POST["login"]) )
            {
                $username = $_POST["username"];
		$password = $_POST["password"];

		$han = $v->doLogin($username,$password); //sanitize and try to login 
		if( $han == true )
		{
                    echo 'Login successful!';
		}
		else
		{
                    echo 'Login invalid!';
		}
				
		//$v->dx($username,$password);
            }
        //}
	break;
		
	case "register":
	//{
            $v = Engine::loadmod('register','register.class.php','Register');
            if( isset($_GET['r']) )
            {
                if( $_GET['r'] == "true" )
		{
                    $v->fetchtemplate('register','validate.php');
		}
            }
            else
            {
                $v->fetchtemplate('register','index.php'); //Module directory, template filename
            }
			
            if( isset($_POST["register"]) )
            {
		$email = $_POST["email"];
		$username = $_POST["username"];
		$password = $_POST["password"];
				
		$v->doRegister($email,$username,$password); //Sanitize and register variables
            }

            if( isset($_POST["validate"]) )
            {
		$username = $_POST["username"];
		$vkey = $_POST["vkey"];
		$v->doValidate($username,$vkey); //Check if validation input is valid
            }
	//}
	break;
		
	case "news":
	//{
            $v = Engine::loadmod('news','news.class.php','News');
            $v->fetchtemplate('news','index.php'); //Module directory, template filename
			
            $v->show(10); //Ammount of news articles to display
	//}
	break;
		
	/*case "forum":
	//{
            $v = Engine::loadmod('forum','forum.class.php','Forum');
            $v->fetchtemplate('forum','index.php');
			
            if(isset($_GET['cat']) && !empty($_GET['cat']))
            {
                $v->getCat($_GET['cat']);
            }
	//}*/

	default:
	//{
            handle(IDX);
	//}

    }
}

?>