#!/usr/local/bin/php
<?php
include("config.php");

date_default_timezone_set('Canada/Pacific');

$con = mysql_connect($dbserver,$dbuser,$dbpass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname, $con);
//$sql = " select * from `reads` where username='$_GET[user]' and post_id='$_GET[id]'";
//$sql = "INSERT INTO `reads` VALUES ('$_GET[user]','$_GET[id]')";

//echo $sql;
//if (!mysql_query($sql,$con))
//  {
//  die('Error: ' . mysql_error());
//  }
$datestamp=time();
//mysql_select_db("forum", $con);
$sql = "INSERT INTO ".$dbprefix."_logs VALUES ('$_GET[user]','$_GET[id]', $datestamp, 'Read')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);
?>
