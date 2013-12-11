<?php
error_reporting(0);
if( !DEFINED('ihere') ) { die(); } //slowly and painfully

function printerror($e)
{
    switch ($e)
    {
        case 'empty':
            die('One or more fields have been left blank. Please <a href="javascript:history.back();">try again</a>.');
        break;
        case 'dblogin':
            die('Could not connect to database. Please verify your information and
                 <a href="javascript:history.back();">try again</a>.');
        break;
        case 'dbsel':
            die('Could not connect to specified database. Login information seems good, DB seems inexistant.
                Please verify your information and <a href="javascript:history.back();">try again</a>.');
        break;
        default:
            die('Unexpected error. Please try again.');
        break;
    }

}

if( isset($_POST['install']) )
{
    if( empty($_POST['title']) || empty($_POST['home']) || empty($_POST['login']) || empty($_POST['host']) ||
        empty($_POST['database']) || empty($_POST['user']) || empty($_POST['pass']) || empty($_POST['passkey'])
      )
    {
        printerror('empty');
    }
    else
    {
        //we're good to go, yo.
        $con = mysql_connect($_POST['host'],$_POST['user'],$_POST['pass']) or printerror('dblogin');
        mysql_select_db($_POST['database'],$con) or printerror('dbsel');
    }

    //still need to do writing, installing, and the rest.

}

?>

<script src="public/sources/jot/jotform.jgz" type="text/javascript"></script>
<script type="text/javascript">
JotForm.init(function(){
JotForm.description('input_1', 'What is your site name?');
JotForm.description('input_4', 'What is the URL to the path of haXMS?');
JotForm.description('input_5', 'What is the URL (file included) to your login page?');
JotForm.description('input_8', 'What is your hostname? (127.0.0.1 default)');
JotForm.description('input_9', 'What is your database name?');
JotForm.description('input_10', 'What is your database username?');
JotForm.description('input_11', 'What is your database password?');
JotForm.description('input_13', 'Yay or nay?');
JotForm.description('input_14', 'Which module for default?');
JotForm.description('input_15', 'You don\'t need to remember this. ');
});
</script>
<link href="public/sources/jot/jotform.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="public/sources/jot/big.css" />
<style type="text/css">
.form-label{
width:150px !important;
}
.form-label-left{
width:150px !important;
}
.form-line{
padding:10px;
}
.form-label-right{
width:150px !important;
}
.form-all{
width:960px;
background:#EDEDED;
color:#000000 !important;
font-family:Verdana;
font-size:18px;
}
</style>

<form class="jotform-form" method="POST" name="install" id="10552052597" accept-charset="utf-8">
<div class="form-all">
<ul class="form-section">
<li id="cid_3" class="form-input-wide">
<div class="form-header-group">
<h2 id="header_3" class="form-header">
haXMS 1.0.0b Installation
</h2>
</div>
</li>
<li id="cid_6" class="form-input-wide">
<div class="form-header-group">
<h2 id="header_6" class="form-header">
Site Information
</h2>
</div>
</li>
<li class="form-line" id="id_1">
<label class="form-label-left" id="label_1" for="input_1"> Site Title </label>
<div id="cid_1" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_1" name="title" size="20" value="haXMS" />
<label class="form-sub-label" for="input_1"> The name of your site. Something fancy. </label></span>
</div>
</li>
<li class="form-line" id="id_4">
<label class="form-label-left" id="label_4" for="input_4"> Home Path </label>
<div id="cid_4" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_4" name="home" size="20" value="http://example.tld/home" />
<label class="form-sub-label" for="input_4"> The URL to haXMS. </label></span>
</div>
</li>
<li class="form-line" id="id_5">
<label class="form-label-left" id="label_5" for="input_5"> Login Path (including file) </label>
<div id="cid_5" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_5" name="login" size="20" value="http://example.tld/home/login.php" />
<label class="form-sub-label" for="input_5"> The URL to your login page (file included). </label></span>
</div>
</li>
<li id="cid_7" class="form-input-wide">
<div class="form-header-group">
<h2 id="header_7" class="form-header">
Database Information
</h2>
</div>
</li>
<li class="form-line" id="id_8">
<label class="form-label-left" id="label_8" for="input_8"> Host </label>
<div id="cid_8" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_8" name="host" size="20" value="127.0.0.1" />
<label class="form-sub-label" for="input_8"> Your hostname. 127.0.0.1 default </label></span>
</div>
</li>
<li class="form-line" id="id_9">
<label class="form-label-left" id="label_9" for="input_9"> Database </label>
<div id="cid_9" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_9" name="database" size="20" />
<label class="form-sub-label" for="input_9"> Your database name. </label></span>
</div>
</li>
<li class="form-line" id="id_10">
<label class="form-label-left" id="label_10" for="input_10"> Username </label>
<div id="cid_10" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_10" name="user" size="20" />
<label class="form-sub-label" for="input_10"> Your database username. </label></span>
</div>
</li>
<li class="form-line" id="id_11">
<label class="form-label-left" id="label_11" for="input_11"> Password </label>
<div id="cid_11" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_11" name="pass" size="20" />
<label class="form-sub-label" for="input_11"> Your database password. </label></span>
</div>
</li>
<li id="cid_12" class="form-input-wide">
<div class="form-header-group">
<h2 id="header_12" class="form-header">
Settings
</h2>
</div>
</li>
<li class="form-line" id="id_15">
<label class="form-label-left" id="label_15" for="input_15"> Pass Key </label>
<div id="cid_15" class="form-input"><span class="form-sub-label-container"><input type="text" class="form-textbox" id="input_15" name="passkey" size="20" />
<label class="form-sub-label" for="input_15"> 64 character hardcoded password. </label></span>
</div>
</li>
<li class="form-line" id="id_2">
<div id="cid_2" class="form-input-wide">
<div style="margin-left:156px" class="form-buttons-wrapper">
<button id="input_2" type="submit" name="install" class="form-submit-button">
Install
</button>
</div>
</div>
</li>
<li style="display:none">
Should be Empty:
<input type="text" name="website" value="" />
</li>
</ul>
</div>
<input type="hidden" id="simple_spc" name="simple_spc" value="10552052597" />
<script type="text/javascript">
document.getElementById("si" + "mple" + "_spc").value = "10552052597-10552052597";
</script>
</form>