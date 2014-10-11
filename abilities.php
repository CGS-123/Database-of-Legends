<?php 
require_once("database.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if ($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
    }

    $myQuery = "SELECT c.name, a.passive, a.Q, a.W, a.E, a.ultimate FROM characters c INNER JOIN
    abilities a ON a.fk_cid = c.id
    ORDER BY c.name";

    $result = $mysqli->query($myQuery) or die($mysqli->error);

    $data = $result->fetch_all( MYSQLI_ASSOC );
    echo json_encode( $data );

    $mysqli->close();

}

?>