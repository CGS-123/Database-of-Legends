<?php
require_once("database.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if ($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
    }

    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata, true);

    $username =$data['username'];

    $myQuery = "SELECT DISTINCT cc.name, cl.lane_name FROM users u INNER JOIN
                            custom_characters cc ON u.id = cc.fk_uid INNER JOIN
                            custom_character_lanes ccl ON ccl.fk_custom_cid = cc.id INNER JOIN
                            custom_lanes cl ON cl.id = ccl.fk_custom_lid
                            WHERE u.username = '".$username."'
                            ORDER BY cl.lane_name";

    $result = $mysqli->query($myQuery) or die($mysqli->error);

    $data = $result->fetch_all( MYSQLI_ASSOC );
    echo json_encode( $data );

    $mysqli->close();

}
?>