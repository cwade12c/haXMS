<?php

class Register extends Engine
{
    #####CONFIG#####
    /**
     * 
     * @var int min_usr Minimum characters required in username
     * @var int max_usr Maximum characters a username may have
     * @var int min_pwd Minimum characters required in password
     * @var int max_pwd Maximum characters a password may have
     * @var string register Page of registration
     * @var string param Parameter char
     * @var string subject Email subject
     * @var string pass_key Hardcoded passkey for additional security
     */
    private $min_usr = 3;
    private $max_usr = 24;
    private $min_pwd = 8;
    private $max_pwd = 32;
    private $register = 'index.php?act=register';
    private $param = 'r';
    private $subject = 'Registration Confirmation';
    private $pass_key = PKEY;

    /**
     *
     * @var string email
     * @var string username
     * @var string password
     * @var string vkey
     */
    private $email, $username, $password, $vkey;
    ####/CONFIG#####

    /**
     *
     * @param string $e Email
     * @param string $u Username
     * @param string $p Password
     * Void
     */
    public function doRegister($e,$u,$p)
    {
        $min_usr = $this->min_usr;
	$max_usr = $this->max_usr;
	$min_pwd = $this->min_pwd;
	$max_pwd = $this->max_pwd;
	$register = $this->register;
	$param = $this->param;
	$subject = $this->subject;
	$mail = $this->email = $e;
	$user = $this->username = $u;
	$pass = $this->password = $p;
	$pass_key = $this->pass_key;

	if( !filter_var($mail,FILTER_VALIDATE_EMAIL) )
	{
            exit("The email: " . htmlspecialchars($mail) . " is invalid.");
	}
		
	if( strlen($user) < $min_usr )
	{
            exit("Your username is " . (($min_usr) - strlen($user)) . " characters under the limit.");
	}
	else if( strlen($user) > $max_usr )
	{
            exit("Your username is " . (strlen($user) - ($max_usr)) . " characters over the limit.");
	}		
		
	if( strlen($pass) < $min_pwd )
	{
            exit("Your password is " . (($min_pwd) - strlen($pass)) . " characters under the limit.");
	}
	else if( strlen($pass) > $max_pwd )
	{
            exit("Your password is " . (strlen($pass) - ($max_pwd)) . " characters over the limit.");
	}
		
	//Now, if we run into no trouble, lets gen validation, and securely register.
		
	$vkey = md5(uniqid(rand()));
	$salt = parent::genkey(5);
		
	##<!-- Sanitize Email -->##
            $mail = mysql_real_escape_string($mail);
		
	##<!-- Sanitize Username -->##
            /*$user = trim($user);
            $user = htmlspecialchars($user,ENT_QUOTES);*/
            $user = parent::protect($user);
		
	##<!-- Hash Password -->##
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
		
	##<!-- Does email exist? -->
            $chkmail = mysql_query("SELECT * FROM `hxm_members` WHERE `email` = '$mail'");
            $getmail = mysql_num_rows($chkmail);
            if( $getmail > 0 )
            {
                exit("The email address: " . $mail . " already exists in our database.");
            }
		
	##<!-- Does username exist? -->
            $chkuser = mysql_query("SELECT * FROM `hxm_members` WHERE `username` = '$user'");
            $getuser = mysql_num_rows($chkuser);
            if( $getuser > 0 )
            {
                exit("The username: " . $user . " already exists in our database.");
            }
			
	##<!-- Does captcha pass? -->
            $privatekey = "NkxkSHZMOFNBQUFBQUNUSjFyV2tWd2FxS04wUHJXck5DYUFESHV5Qw==";
            $resp = recaptcha_check_answer  (base64_decode($privatekey),
						           $_SERVER["REMOTE_ADDR"],
							   $_POST["recaptcha_challenge_field"],
							   $_POST["recaptcha_response_field"]);
            if( !$resp->is_valid )
            {
                exit("The reCAPTCHA was entered incorrectly.");
            }
			
			
	$maxq = mysql_query("SELECT max(id) FROM `hxm_members`");
	$maxg = mysql_fetch_array($maxq);
	$id = $maxg['max(id)'] + 1;
		
	$query = mysql_query("INSERT INTO `hxm_members` VALUES ('$id','$mail','$user','$pass','$salt','$vkey','1')");
		
	if( $query )
	{
            mail($mail,$subject,"Thank you for registering with " . SITE .".\nBefore you can use your account,
			                     you must verify your account. Your verification code is:\n" . $vkey);
            echo "Registering...<br />";
            echo "<meta http-equiv=\"refresh\" content=\"0; url=" . $register . "&" . $param . "=true\">";
	}

    }

    /**
     *
     * @param string $u Username
     * @param string $v Vkey
     * Void
     */
    public function doValidate($u,$v)
    {
        global $min_usr, $max_usr;
		
	$user = $this->username = $u;
	$key = $this->vkey = $v;
		
		
	/*if(strlen($user) > $max_usr || strlen($user) < $min_usr)
	{
            exit("Unable to validate :: Invalid username!");
	}*/
		
	##<!-- Does captcha pass? -->
            $privatekey = "NkxkSHZMOFNBQUFBQUNUSjFyV2tWd2FxS04wUHJXck5DYUFESHV5Qw==";
            $resp = recaptcha_check_answer  (base64_decode($privatekey),
							   $_SERVER["REMOTE_ADDR"],
							   $_POST["recaptcha_challenge_field"],
							   $_POST["recaptcha_response_field"]);
            if( !$resp->is_valid )
            {
                exit("The reCAPTCHA was entered incorrectly.");
            }
		
	##<!-- Sanitize Username -->##
            /*$user = trim($user);
            $user = htmlspecialchars($user,ENT_QUOTES);*/
            $user = parent::protect($user);
			
	##<!-- Sanitize vkey -->##
            $key = strip_tags($key);
            $key = parent::protect($key);
			
		
	$query = mysql_query("SELECT * FROM hxm_members WHERE `username` = '$user' AND `key` = '$key'");
	$result = mysql_num_rows($query);
		
	if( $result > 0 && $result < 2 )
	{
            $update = mysql_query("UPDATE hxm_members SET `group` = '1' WHERE `username` = '$user' AND `key` = '$key'");
	}
		
	if( $update )
	{
            header("Location: " . HOME);
	}
	else
	{
            exit("Invalid key or user has already validated.");
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