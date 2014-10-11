<?php

    session_start();
    require_once("database.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {


		$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

		if ($mysqli -> connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
		}


        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata, true);

        $username = $data['username'];
        $charName = $data['charName'];
        $passive = $data['passive'];
        $q = $data['q'];
        $w = $data['w'];
        $e = $data['e'];
        $ultimate = $data['ultimate'];

        $stmt = $mysqli->prepare("INSERT INTO custom_abilities (fk_custom_cid, passive, Q, W, E, ultimate)
                                  VALUES ((SELECT cc.id FROM users u INNER JOIN
                                  custom_characters cc ON u.id = fk_uid
                                  WHERE cc.name = ? AND u.username = ?), ?, ? ,? ,? ,?);");

       $stmt->bind_param("sssssss", $charName, $username, $passive, $q, $w, $e, $ultimate);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

        $mysqli->close();

        echo 'Added abilities';

    }

?>