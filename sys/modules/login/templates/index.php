<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo SITE; ?> || Login</title>

<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<style type="text/css">
body
{
	text-align: center;
}
A:link
{
	text-decoration: none;
	color: #FFFFFF;
}
A:visited
{
	text-decoration: none;
	color: #FFFFFF;
}
.logform
{

/* http://www.colorzilla.com/gradient-editor/ */
	background: #b5bdc8;
	background: -moz-linear-gradient(top, #b5bdc8 0%, #828c95 36%, #28343b 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b5bdc8), color-stop(36%,#828c95), color-stop(100%,#28343b));
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b5bdc8', endColorstr='#28343b',GradientType=0 );
/* http://www.colorzilla.com/gradient-editor/ */

	width: 400px;
	height: 400px;
	margin-left: auto;
	margin-right: auto;
	-moz-border-radius: 12px;
	-webkit-border-radius: 12px;
	border-radius: 12px;
}	
.logbox
{
	width: 50%;
	border: 2px solid;
	margin-left: auto;
	margin-right: auto;
}
.submit
{
	height: 40px;
	width: 33%;
}
</style>
</head>

<body>
<article>
<form method="POST" class="logform">
<label for="username">Username</label>
<br />
<input type="text" name="username" class="logbox" />
<br />
<label for="password">Password</label>
<br />
<input type="password" name="password" class="logbox" />
<br />
<br />
<center>
<?php
require_once(PATH . '/lib/recaptchalib.php');
echo recaptcha_get_html(REC_PUB);
?>
</center>
<br />
<input type="submit" name="login" value="Login!" class="submit" />
<br />
<?php
copyright(); #This registration system is provided to you free. Please leave the copyright intact. :)
?>
</form>
</article>
</body>
</html>
