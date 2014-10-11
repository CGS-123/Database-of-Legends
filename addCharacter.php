<?php
require_once("database.php");


//ensure data was posted and not get
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    //check to make sure database can be connected to
    if ($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL: (" . $mysqli -> connect_errno . ")" . $mysqli -> connect_error;
    }

    //angular sends data in JSON format. This puts the json data into an object
    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata, true);

    $username = $data['username'];

    $name = $data['name'];
    $description = $data['description'];
    $gender = $data['gender'];
    $race = $data['race'];
    $birthplace = $data['birthplace'];
    $occupation = $data['occupation'];
    $faction = $data['faction'];

    $top = $data['top'];
    $jungle = $data['jungle'];
    $mid = $data['mid'];
    $support_lane = $data['support_lane'];
    $adc = $data['adc'];

    $assassin = $data['assassin'];
    $fighter = $data['fighter'];
    $mage = $data['mage'];
    $support_role = $data['support_role'];
    $tank = $data['tank'];
    $marksman = $data['marksman'];

    $stmt = $mysqli->prepare("INSERT INTO custom_characters (name, fk_uid, description, gender, race, birthplace, occupation, faction)
                              VALUES (?, (SELECT id FROM users WHERE username = ?),
                              ?, ? , ?, ?, ?, ?);");

    $stmt->bind_param("ssssssss", $name, $username, $description, $gender, $race, $birthplace, $occupation, $faction);

    $stmt->execute();
    $stmt->fetch();

    $stmt->close();



    if($assassin == 1)
    {
        $stmt = $mysqli->prepare("INSERT INTO custom_character_roles (fk_custom_cid, fk_custom_rid)
                                 VALUES ((SELECT cc.id FROM users u INNER JOIN
                                 custom_characters cc ON cc.fk_uid = u.id
                                 WHERE u.username = ? AND cc.name = ? ),1);");

        $stmt->bind_param("ss", $username, $name);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

    }

    if($fighter == 1)
    {
        $stmt = $mysqli->prepare("INSERT INTO custom_character_roles (fk_custom_cid, fk_custom_rid)
                                 VALUES ((SELECT cc.id FROM users u INNER JOIN
                                 custom_characters cc ON cc.fk_uid = u.id
                                 WHERE u.username = ? AND cc.name = ? ),2);");

        $stmt->bind_param("ss", $username, $name);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

    }

    if($mage == 1)
    {
        $stmt = $mysqli->prepare("INSERT INTO custom_character_roles (fk_custom_cid, fk_custom_rid)
                                 VALUES ((SELECT cc.id FROM users u INNER JOIN
                                 custom_characters cc ON cc.fk_uid = u.id
                                 WHERE u.username = ? AND cc.name = ? ),3);");

        $stmt->bind_param("ss", $username, $name);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

    }

    if($support_role == 1)
    {
        $stmt = $mysqli->prepare("INSERT INTO custom_character_roles (fk_custom_cid, fk_custom_rid)
                                 VALUES ((SELECT cc.id FROM users u INNER JOIN
                                 custom_characters cc ON cc.fk_uid = u.id
                                 WHERE u.username = ? AND cc.name = ? ),4);");

        $stmt->bind_param("ss", $username, $name);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

    }

    if($tank == 1)
    {
        $stmt = $mysqli->prepare("INSERT INTO custom_character_roles (fk_custom_cid, fk_custom_rid)
                                 VALUES ((SELECT cc.id FROM users u INNER JOIN
                                 custom_characters cc ON cc.fk_uid = u.id
                                 WHERE u.username = ? AND cc.name = ? ),5);");

        $stmt->bind_param("ss", $username, $name);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

    }

    if($marksman == 1)
    {
        $stmt = $mysqli->prepare("INSERT INTO custom_character_roles (fk_custom_cid, fk_custom_rid)
                                 VALUES ((SELECT cc.id FROM users u INNER JOIN
                                 custom_characters cc ON cc.fk_uid = u.id
                                 WHERE u.username = ? AND cc.name = ? ),6);");

        $stmt->bind_param("ss", $username, $name);

        $stmt->execute();
        $stmt->fetch();

        $stmt->close();

    }










    if($top == 1)
         {
             $stmt = $mysqli->prepare("INSERT INTO custom_character_lanes (fk_custom_cid, fk_custom_lid)
                                      VALUES ((SELECT cc.id FROM users u INNER JOIN
                                      custom_characters cc ON cc.fk_uid = u.id
                                      WHERE u.username = ? AND cc.name = ? ),1);");

             $stmt->bind_param("ss", $username, $name);

             $stmt->execute();
             $stmt->fetch();

             $stmt->close();

         }

    if($jungle == 1)
         {
             $stmt = $mysqli->prepare("INSERT INTO custom_character_lanes (fk_custom_cid, fk_custom_lid)
                                      VALUES ((SELECT cc.id FROM users u INNER JOIN
                                      custom_characters cc ON cc.fk_uid = u.id
                                      WHERE u.username = ? AND cc.name = ? ),2);");

             $stmt->bind_param("ss", $username, $name);

             $stmt->execute();
             $stmt->fetch();

             $stmt->close();

         }

    if($mid == 1)
         {
             $stmt = $mysqli->prepare("INSERT INTO custom_character_lanes (fk_custom_cid, fk_custom_lid)
                                      VALUES ((SELECT cc.id FROM users u INNER JOIN
                                      custom_characters cc ON cc.fk_uid = u.id
                                      WHERE u.username = ? AND cc.name = ? ),3);");

             $stmt->bind_param("ss", $username, $name);

             $stmt->execute();
             $stmt->fetch();

             $stmt->close();

         }

    if($support_lane == 1)
         {
             $stmt = $mysqli->prepare("INSERT INTO custom_character_lanes (fk_custom_cid, fk_custom_lid)
                                      VALUES ((SELECT cc.id FROM users u INNER JOIN
                                      custom_characters cc ON cc.fk_uid = u.id
                                      WHERE u.username = ? AND cc.name = ? ),4);");

             $stmt->bind_param("ss", $username, $name);

             $stmt->execute();
             $stmt->fetch();

             $stmt->close();

         }

    if($adc == 1)
         {
             $stmt = $mysqli->prepare("INSERT INTO custom_character_lanes (fk_custom_cid, fk_custom_lid)
                                      VALUES ((SELECT cc.id FROM users u INNER JOIN
                                      custom_characters cc ON cc.fk_uid = u.id
                                      WHERE u.username = ? AND cc.name = ? ),5);");

             $stmt->bind_param("ss", $username, $name);

             $stmt->execute();
             $stmt->fetch();

             $stmt->close();

         }




    $mysqli->close();
}

?>