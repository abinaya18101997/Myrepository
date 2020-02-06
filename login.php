<!DOCTYPE html>
<head>
<title>floor seating plan </title>
</head>
<body>
<?php

// Grab Manager submitted information
$hrmsid = $_POST["hrms_id"];
$password = $_POST["password"];

// Connect to the database
$con = mysql_connect("localhost","root","");
// Make sure we connected successfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

//database to use
mysql_select_db("my_dbname",$con);

$result = mysql_query("SELECT hrms_id, password FROM manager WHERE hrms_id = $hrmsid");

$row = mysql_fetch_array($result);

if($row["hrms_id"]==$hrmsid && $row["password"]==$password)
    echo"Login Successful.";
else
    echo"Sorry, your credentials are not valid, Please try again.";
?>
</body>
</html>