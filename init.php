#!/usr/local/bin/php
<?php
include("config.php");

//////////////////////////////////////////////////////////
function get_post($id) {	
include("config.php");
$username = $_GET[user]; //"Farshid";
$day = $_GET[day];
$con = mysql_connect($dbserver,$dbuser,$dbpass);
if (!$con)
  { echo "error";
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname, $con);

// getting read post id
$sql = "Select * from ".$dbprefix."_logs where user=\"$username\" and postid=$id";
$result = mysql_query($sql,$con) or die('Error:1 ' . mysql_error());
//$row_read = mysql_fetch_array($result) or die('Error:2 ' . mysql_error());
if (mysql_fetch_array($result)) {
	$read = "true";
} else {
	$read = "false";
}
//getting post 
$sql = "Select * from ".$dbprefix."_posts where id=$id and date<$day ";
$result = mysql_query($sql,$con) or die('Error: ' . mysql_error());
$row = mysql_fetch_array($result) or die('Error: ' . mysql_error());


$daynames = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');

if  (strlen($row['date']) == 1) { // >= 0 && $row['date'] <= 5) { 
	$weekday = $daynames[$row['date']].", Oct ".(string)($row['date']+17).", 2009";
}
else {
	$weekday = $row['date'];
} 

	echo "{
       \"id\": \"" . $row['id'] . "\", 
       \"name\": \" " .$row['subject'] ."\",
	   \"data\": {
		   \"read\": " .$read . ",
       		\"date\": \" " . $weekday . " \", 
       		\"author\": \" " .$row['author'] ."\",
       		\"topic\": \" " . $row['topic'] . " \", 
       		\"body\": \" " .$row['body'] ."\"
	   },
        \"children\": [";
	$sql = "Select * from ".$dbprefix."_posts where parent =".$row['id']." and date<$day" ;
	$result = mysql_query($sql,$con) or die('Error: ' . mysql_error());
	$i = 0; 
	while($row = mysql_fetch_array($result)) {
		if ($i > 0) 
			echo " ,";
		$i++;
		get_post($row['id']);
		//echo $row['id'];
	}
	echo "]}";  

//mysql_close($con);

} //function get_post
/////////////////////////////////////////////////////////////

$user=$_GET[user];

//check login 
session_start();
if(!session_is_registered($user)){
//Demo
	header("location:index.html");
//	echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=index.html\">";
} 

//select topic
if ($_GET[topic] == 2 and $user != "guest") {
	$postid="20001";
}
else {
	$postid="10001";
}

//get posts info
get_post($postid);

//add root to read posts 
date_default_timezone_set('Canada/Pacific');

$con = mysql_connect($dbserver,$dbuser,$dbpass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname, $con);
$datestamp=time();
$sql = "INSERT INTO ".$dbprefix."_logs VALUES ('$user', '$postid', '$datestamp', 'Read')";
$result = mysql_query($sql,$con) or die('Error: ' . mysql_error());

mysql_close($con);

?>
