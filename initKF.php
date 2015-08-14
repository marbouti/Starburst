<?php
function get_post($id) {	
$username = $_GET[user]; //"Farshid";
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("forum", $con);

// getting read post id
$sql = "Select * from `reads` where username=\"$username\" and post_id=$id";
$result = mysql_query($sql,$con) or die('Error:1 ' . mysql_error());
//$row_read = mysql_fetch_array($result) or die('Error:2 ' . mysql_error());
if (mysql_fetch_array($result)) {
	$read = "true";
} else {
	$read = "false";
}
//getting post 
$sql = "Select * from postsKF where id=$id";
$result = mysql_query($sql,$con) or die('Error: ' . mysql_error());
$row = mysql_fetch_array($result) or die('Error: ' . mysql_error());

	echo "{
       \"id\": \" " . $row['id'] . " \", 
       \"name\": \" " .$row['subject'] ."\",
	   \"data\": {
		   \"read\": " .$read . ",
       		\"date\": \" " . $row['date'] . " \", 
       		\"author\": \" " .$row['author'] ."\",
       		\"topic\": \" " . $row['topic'] . " \", 
       		\"body\": \" " .$row['body'] ."\"
	   },
        \"children\": [";
	$sql = "Select * from postsKF where parent =".$row['id'];
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

get_post("20001");
?>