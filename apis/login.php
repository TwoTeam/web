<?php
include_once '../database.php';
$username = $_POST["username"];
$password = sha1($_POST["password"]);

$query = sprintf("SELECT * FROM users WHERE username = '%s' AND password = '%s'", mysqli_real_escape_string($link, $username), mysqli_real_escape_string($link, $password));
$result = mysqli_query($link, $query);

if(mysqli_num_rows($result) == 1){
    //SUCCESS
    $user = mysqli_fetch_array($result);
    $response = array("logged" => true ,"name" => $user["name"], "surname" => $user["surname"], "username" => $user["username"]);
} else {
    //NOPE.avi
    $response = array("logged" => false, "message" => "Uporabnik s takšnim uporabniškim imenom in geslom ne obstaja!");
}

echo json_encode($response);