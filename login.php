#!/usr/local/bin/php
<?php
include("config.php");

$username=$_POST['username'];
$password=$_POST['password']; 

$con = mysql_connect($dbserver,$dbuser,$dbpass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname, $con);

// getting read post id
$sql = "Select * from ".$dbprefix."_users where username=\"$username\" and password=\"$password\" ";
$result = mysql_query($sql,$con) or die('Error: ' . mysql_error());

$count=mysql_num_rows($result);

if($count==1){
	$row = mysql_fetch_array($result) or die('Error: ' . mysql_error());
	$topic = $row['topic'];
	$day = 7;
session_register($username);
//session_register($password);
header("location:forum.php?user=$username&topic=$topic&day=$day&id=0");
}
else {
echo "<font size=+1> Username or Password is invalid. Please use back arrow to go back to the login page and try again. </font>";
}

?>
