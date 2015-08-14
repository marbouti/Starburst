#!/usr/local/bin/php
<?php
include("config.php");
//echo $_POST['Selec'];
//echo " Thanks! ";

if (empty($_POST[subject]) | empty($_POST[body]))
{
	die('<font size=+1> Please make sure to enter both subject and body of message. Click on the back arrow to go back to your post in the forum. </font>');
}

date_default_timezone_set('Canada/Pacific');
$con = mysql_connect($dbserver,$dbuser,$dbpass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($dbname, $con);

//Demo
$today = date("M j, Y, g:i a"); 
//$today = $_POST[date];

//$n = $_POST['Frm'];
//$body = addslashes($_POST[body]);
$body = htmlspecialchars($_POST[body], ENT_QUOTES);
//$body = addslashes($body);
$body = str_replace("\\","", $body);
$body = str_replace("\r\n", "<br>", $body);
//$body = nl2br($body);
$subject=htmlspecialchars($_POST[subject]);
$sql = "INSERT INTO ".$dbprefix."_posts (date,author,subject,topic,parent,body)
VALUES ('$today','$_POST[author]','$subject','$_POST[topic]','$_POST[id]','$body')";
//echo $sql;
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

//$sql="select LAST_INSERT_ID() from posts limit 1";
//$result = mysql_query($sql,$con) or die('Error: ' . mysql_error());
//$row = mysql_fetch_array($result) or die('Error: ' . mysql_error());

$postid=mysql_insert_id();
$datestamp=time();
$sql = "INSERT INTO ".$dbprefix."_logs VALUES ('$_POST[author]',$postid, $datestamp,'Post')";
$result = mysql_query($sql,$con) or die('Error: ' . mysql_error());

mysql_close($con);

header("location:forum.php?user=$_POST[author]&topic=$_POST[topic]&day=$_POST[day]&id=$postid");//$_POST[id]");
?>
<!--meta http-equiv="refresh" content="0;URL=forum.php?user=<?echo $_POST[author];?>&topic=<?echo $_POST[topic];?>&day=<?echo $_POST[day];?>">
