<?php 
require_once("database.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if ($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
    }

    $myQuery = "SELECT DISTINCT c.name, l.lane_name
    FROM characters c INNER JOIN
    character_lanes cl ON cl.fk_cid = c.id INNER JOIN
    lanes l ON l.id = cl.fk_lid
    ORDER BY l.lane_name";

    $result = $mysqli->query($myQuery) or die($mysqli->error);

    $data = $result->fetch_all( MYSQLI_ASSOC );
    echo json_encode( $data );

    $mysqli->close();

}
?>