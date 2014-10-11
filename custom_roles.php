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

$myQuery = "SELECT DISTINCT cc.name, cr.role_name FROM users u INNER JOIN
                        custom_characters cc ON u.id = cc.fk_uid INNER JOIN
                        custom_character_roles ccr ON ccr.fk_custom_cid = cc.id INNER JOIN
                        custom_roles cr ON cr.id = ccr.fk_custom_rid
                        WHERE u.username = '".$username."'
                        ORDER BY cr.role_name";

$result = $mysqli->query($myQuery) or die($mysqli->error);

$data = $result->fetch_all( MYSQLI_ASSOC );
echo json_encode( $data );

$mysqli->close();
?>