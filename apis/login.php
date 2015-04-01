<?php
include_once '../database.php';

$login = $_REQUEST["user"];
$password = sha1($_REQUEST["password"]);

$query = sprintf("SELECT * FROM users WHERE (email = '%s' OR username = '%s') AND password = '%s'", mysqli_real_escape_string($link, $login), mysqli_real_escape_string($link, $login), mysqli_real_escape_string($link, $password));
$result = mysqli_query($link, $query);
if (!empty($login)) {
    if (mysqli_num_rows($result) == 1) {
        //SUCCESS
        $user = mysqli_fetch_array($result);
        $response["result"][] = array("response" => true, "name" => $user["name"], "surname" => $user["surname"], "id" => $user["id"]);
    } else {
        //NOPE.avi
        $response["result"][] = array("response" => false, "message" => "Uporabnik s taksnim uporabniskim imenom in geslom ne obstaja!");
    }
} else {
    $response["result"][] = array("response" => false, "message" => "E-naslov ni veljaven!");
}

echo json_encode($response);
