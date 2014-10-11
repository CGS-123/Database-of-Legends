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


        $stmt = $mysqli->prepare("DELETE cc FROM users u INNER JOIN
                                  custom_characters cc ON u.id = cc.fk_uid
                                  WHERE cc.name = ? AND u.username= ?");



        $stmt->bind_param("ss", $charName, $username);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

        $mysqli->close();

        echo "Values deleted.";

    }

?>