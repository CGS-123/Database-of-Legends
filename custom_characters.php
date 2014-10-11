<?php
require_once("database.php");

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

if ($mysqli -> connect_errno)
{
	echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
}


$postdata = file_get_contents("php://input");
$data = json_decode($postdata, true);

$username =$data['username'];


$myQuery = "SELECT * FROM custom_characters WHERE fk_uid = (SELECT id FROM users WHERE username='".$username."') ";
$result = $mysqli->query($myQuery) or die($mysqli->error);

$data = $result->fetch_all( MYSQLI_ASSOC );
echo json_encode( $data );

$mysqli->close();
?>