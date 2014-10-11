<?php 
require_once("database.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if ($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
    }

    $myQuery = "SELECT DISTINCT c.name, r.role_name
    FROM characters c INNER JOIN
    character_roles cr ON cr.fk_cid = c.id INNER JOIN
    roles r ON r.id = cr.fk_rid
    ORDER BY r.role_name";

    $result = $mysqli->query($myQuery) or die($mysqli->error);

    $data = $result->fetch_all( MYSQLI_ASSOC );
    echo json_encode( $data );

    $mysqli->close();
}
?>