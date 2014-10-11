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

        /*$username =mysqli->mysql_real_escape_string($username);
        $password =mysqli->mysql_real_escape_string($password);*/

        $query = "SELECT id, username FROM users WHERE username='".$username."' AND password='".$password."'";

        $result = $mysqli->query($query) or die($mysqli->error);

        $data = $result->fetch_all( MYSQLI_ASSOC );

	    echo json_encode( $data );

        $mysqli->close();

		

	}
?>