<?php

    session_start();
    require_once("database.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

		// 1. Connect to Database
		$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

		if ($mysqli -> connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
		}


        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata, true);


        $username =$data['username'];
        $password =$data['password'];

        $stmt = $mysqli->prepare("SELECT 1 FROM users WHERE username = ?");

        $stmt->bind_param("s", $username);

        $result = 0;

        $stmt->bind_result($result);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

        if($result == 0)
        {

        	$istmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?,?)");

        	$istmt->bind_param("ss", $username, $password);

        	$istmt->execute();

        	$istmt->close();

        	echo "Successfully registered";
        }

        else
        {
        	echo "That username is taken.";
        }

        $mysqli->close();



	}


?>