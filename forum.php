#!/usr/local/bin/php
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?
error_reporting(0);
session_start();
$username= $_GET['user'];
if(!session_is_registered($username)){
//Demo
	echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=index.html\">";
} 
?> 

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Visual Discussion Forum</title>

<!-- CSS Files -->
<link type="text/css" href="css/base.css" rel="stylesheet" />
<link type="text/css" href="css/Hypertree.css" rel="stylesheet" />

<!--[if IE]><script language="javascript" type="text/javascript" src="../../Extras/excanvas.js"></script><![endif]-->

<!-- JIT Library File -->
<script language="javascript" type="text/javascript" src="jit.js"></script>

<!-- Example File -->
<script language="javascript" type="text/javascript" src="forum.js"></script>

</head>
<input type="hidden" id="user" name="user" size="40" dir="ltr" value = "<?echo $_GET[user];?>">
<body onload="init(<?echo $_GET[topic]?>,'<?echo $_GET[user]?>',<?echo $_GET[day];?>,<?echo $_GET[id];?>)">

<div id="container">

<div id="center-container">
    <div id="infovis"></div>    
</div>

<div id="right-container">
<p align="right">Welcome <?echo $_GET[user];?> (<a href="logout.php">Logout</a>) </p>
<div id="inner-details"></div>

<form action="post.php" method="post">
<fieldset>
<legend> <div id="reply">  </div> </legend>
Subject: <input type="text" id="subject" name="subject" style="width:400px;" dir="ltr">
<input type="hidden" id="author" name="author" size="40" dir="ltr" value = "<?echo $_GET[user];?>" -->
<!--br/>Author: <input type="text" id="author" name="author" size="40" dir="ltr"-->
<input type="hidden" id="topic" name="topic" size="40" dir="ltr" value = "<?echo $_GET[topic];?>" >
<input type="hidden" id="day" name="day" size="40" dir="ltr" value = "<?echo $_GET[day];?>">
<!--br/>Date: <input type="text" id="date" name="date" size="40" dir="ltr"-->
 <input type="hidden" id="id" name="id" size="40" dir="ltr"> <br />
<textarea name="body" id="body" style="width:550px;" rows="15"></textarea>
<div id="reply2"> </div>
<p align="right">
<input type="submit" value="Reply">
</p>
</fieldset>
</form>

</div>

<div id="log"></div>
</div>
</body>
</html>
