<?php

class Login extends Engine
{
    #####CONFIG#####
    /**
     *
     * @var int haxms Are we using haXMS?
     * @var int pass_type Hash algorithm
     * @var string pass_key Hardcoded passkey for additional security
     * @var int time Minutes before cookie expires
     */
    private $haxms = 1;
    private $pass_type = 0;
    private $pass_key = PKEY;
    private $cookie_prefix = 'hxm_';
    private $time = 120;

    /**
     *
     * @var string username
     * @var string password
     */
    private $username, $password;
    ####/CONFIG#####

    /*
     * @var string $u Username
     * @var string $p Password
     * @return boolean Is login true or false
     */
    public function doLogin($u,$p)
    {
        $haxms = $this->haxms;
	$pass_type = $this->pass_type;
	$user = $this->username = $u;
	$pass = $this->password = $p;
	$pass_key = $this->pass_key;
	$cookie_prefix = $this->cookie_prefix;
	$time = $this->time;
		
	##<!-- Sanitize Username -->##
            /*$user = trim($user);
            $user = htmlspecialchars($user,ENT_QUOTES);*/
            $user = parent::protect($user);
			
	##!<-- Hash Password -->##
            /*Get Salt*/
            $query_a = mysql_query("SELECT * FROM `hxm_members` WHERE `username` = '$user'");
            $result_a = mysql_num_rows($query_a);
            $data_a = mysql_fetch_array($query_a);
            $salt = $data_a['salt'];

            if( $result_a < 1 )
            {
                return false;
            }
            else
            {
                if( $haxms == 1 )
                {
                    //require(PATH . '/modules/register/classes/register.class.php');
                    switch ($pass_type)
                    {
                        case 0:
                            $s1 = hash("sha256",$user.$pass.$salt);
                            $pass = hash_hmac("sha256",$s1,$pass_key);
			break;
				
			case 1:
                            $s1 = hash("sha1",$user.$pass.$salt);
                            $pass = hash_hmac("sha1",$s1,$pass_key);
                            break;
				
			case 2:
                            $s1 = hash("md5",$user.$pass.$salt);
                            $pass = hash_hmac("md5",$s1,$pass_key);
                            break;
				
			default:
                            $s1 = hash("sha256",$user.$pass.$salt);
                            $pass = hash_hmac("sha256",$s1,$pass_key);
                            break;
                    }
                }
                else
		{
                    $pass = md5($pass); #MD5 default for other purposes...
		}
			
                ##<!-- Does captcha pass? -->
                    $privatekey = "x";
                    $resp = recaptcha_check_answer  (base64_decode($privatekey),
								   $_SERVER["REMOTE_ADDR"],
								   $_POST["recaptcha_challenge_field"],
								   $_POST["recaptcha_response_field"]);
                    if( !$resp->is_valid )
                    {
                        exit("The reCAPTCHA was entered incorrectly.");
                    }
			
                    $query_b = mysql_query("SELECT * FROM `hxm_members` WHERE `username` = '$user' AND `password` = '$pass'");
                    $result_b = mysql_num_rows($query_b);
                    $data_b = mysql_fetch_array($query_b);
		
                    if( $result_b > 0 && $result_b < 2 )
                    {
                        setcookie($cookie_prefix . 'id',$data_b["id"],time()+($time*60));
                        setcookie($cookie_prefix . 'pass',$pass,time()+($time*60));

                        return true;
                    }
                    else
                    {
                        return false;
                    }
            }
    }

    /**
     *
     * Void
     * Checks if user is logged in
     */
    public function chkLogin()
    {
        global $cookie_prefix;
		
        if(
           isset($_COOKIE[$cookie_prefix . "id"])
           &&
           isset($_COOKIE[$cookie_prefix . "pass"])
          )
	{
            #<!-- Sanitize ID -->
                $id = $_COOKIE[$cookie_prefix . "id"];
		/*$id = mysql_real_escape_string($id);
		$id = strip_tags($id);*/
		$id = parent::protect($id);
			
            #<!-- Sanitize Pass -->
		$pass = $_COOKIE[$cookie_prefix . "pass"];
		/*$pass = mysql_real_escape_string($pass);
		$pass = strip_tags($pass);*/
		$pass = parent::protect($pass);
		
            $query = mysql_query("SELECT * FROM `hxm_members` WHERE `id` = '$id' AND `password` = '$pass'");
            $result = mysql_num_rows($query);
            $data = mysql_fetch_array($query);
			
            if( $result != 1 )
            {
                header("Location: " . AUTH);
            }
			
            if( $data["group"] == "0" )
            {
                header("Location: " . AUTH);
            }
	}
	else
	{
            header("Location: " . AUTH);
				
	}
    }

    /**
     *
     * Void
     * @return string Returns current username
     */
    public function setUser()
    {
        global $cookie_prefix;
		
        if(
           isset($_COOKIE[$cookie_prefix . "id"])
           &&
           isset($_COOKIE[$cookie_prefix . "pass"])
          )
	{
            #<!-- Sanitize ID -->
                $id = $_COOKIE[$cookie_prefix . "id"];
		$id = mysql_real_escape_string($id);
		$id = strip_tags($id);
			
            #<!-- Sanitize Pass -->
		$pass = $_COOKIE[$cookie_prefix . "pass"];
		$pass = mysql_real_escape_string($pass);
		$pass = strip_tags($pass);
		
            $query = mysql_query("SELECT * FROM `hxm_members` WHERE `id` = '$id' AND `password` = '$pass'");
            $result = mysql_num_rows($query);
            $data = mysql_fetch_array($query);
			
            if( $result > 0 && $result < 2 )
            {
                return htmlspecialchars_decode($data["username"],ENT_QUOTES);
            }
	}	
    }

    /**
     *
     * @param string $dir Directory to template
     * @param string $file Filename
     * Void
     */
    public function fetchtemplate($dir,$file)
    {
    include(PATH . "/modules/$dir/templates/$file");
    }
}

function copyright()
{
	echo "<a href=\"http://haxme.org/haxms\">Powered by [haXMS]</a>";
}

