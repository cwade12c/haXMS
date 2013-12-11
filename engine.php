<?php

# -- HEADER -- #

if( !DEFINED('haXMS_HERE') ) { die(); }

if( !is_file('hx_config.php') )
{
    DEFINE('ihere','');
    require('sys/hxm_admin/base/installer.php');
}
else
{
    require('hx_config.php');
}

# --/HEADER -- #

# -- COOKIE JAR -- #

class Engine 
{
    /**
     * 
     * @var string dir directory
     * @var string file filename
     * @var string class modulename
     */
    private $dir, $file, $class;

    /**
     * @static init Handles SQL connection, module handler
     */
    public static function init()
    {
        /*run::SQL*/
        $con = mysql_connect(HOST,USER,PASS);
        mysql_select_db(DB,$con) or die(mysql_error());
        /*end::SQL*/

        /*Load Module Handler*/
        if( LISTEN == TRUE )
        {
            require(PATH . '/base/handler.php');

            if( !isset($_GET['act']) )
            {
                $_GET['act'] = IDX;
            }
        }
    }

    /**
     *
     * @param string $dir
     * @param string $file
     * @param string $class
     * @return class Return class as an obj
     */
    public function loadMod($dir,$file,$class)
    {
        require(PATH . "/modules/$dir/classes/$file");

	return new $class;
    }

    /**
     *
     * @param string $input
     * @return string Input will be sanitized
     */
    public function protect($input)
    {
        $input = trim($input); //Step 1: no whitespace
	$input = mysql_real_escape_string($input); //Step 2: protect sql
	$input = htmlspecialchars($input); //Step 3: convert <tags>
		
	return $input;
    }

    /**
     *
     * @param string $input
     * @return string Input will be purified
     */
    public function purify($input)
    {
	$input = stripslashes($input); //Step 1: remove backslashes
	$input = htmlspecialchars_decode($input); //Step 2: convert <tags>
		
	return $input;
    }

    /**
     *
     * @param int $num Length of key
     * @return string Random generated key will be returned
     */
    public function genkey($num)
    {
	$len = $num;
	$char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()[].,;';
	$salt = "";

	for ($x = 0; $x < $len; $x++) 
	{
            $salt .= $char[mt_rand(0, strlen($char))];
	}
		
        return $salt;
    }

    /**
     *
     * @param string $input
     * @param int $num How many times to iterate
     * @param string $hash Hash type
     * @return string Iterated hash output returned
     */
    public function iterate($input,$num,$hash)
    {
	$pass = hash($hash,$input);
		
	for($k = 0; $k < $num; $k++)
	{
            $pass = hash($hash,$pass);
	}
		
	return $pass;
    }
}

# --/COOKIE JAR -- #