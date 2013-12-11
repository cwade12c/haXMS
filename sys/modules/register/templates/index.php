<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo SITE; ?> || Register</title>

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
.regform
{

/* http://www.colorzilla.com/gradient-editor/ */
	background: #1E5799;
	background: -moz-linear-gradient(top, #1E5799 0%, #2989D8 50%, #207cca 51%, #7db9e8 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1E5799), color-stop(50%,#2989D8), color-stop(51%,#207cca), color-stop(100%,#7db9e8));
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1E5799', endColorstr='#7db9e8',GradientType=0 );
/* http://www.colorzilla.com/gradient-editor/ */

	width: 400px;
	height: 400px;
	margin-left: auto;
	margin-right: auto;
	-moz-border-radius: 12px;
	-webkit-border-radius: 12px;
	border-radius: 12px;
}	
.regbox
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
<form method="POST" class="regform">
<label for="email">Email</label>
<br />
<input type="text" name="email" class="regbox" />
<br />
<label for="username">Username</label>
<br />
<input type="text" name="username" class="regbox" />
<br />
<label for="password">Password</label>
<br />
<input type="password" name="password" class="regbox" />
<br />
<br />
<center>
<?php
require_once(PATH . '/lib/recaptchalib.php');
echo recaptcha_get_html(REC_PUB);
?>
</center>
<br />
<input type="submit" name="register" value="Register!" class="submit" />
<br />
<?php
copyright(); #This registration system is provided to you free. Please leave the copyright intact. :)
?>
</form>
</article>
</body>
</html>
