<?php
include_once '../database.php';
$username = $_POST["username"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$password = sha1($_POST["password"]);

$query = sprintf("INSERT INTO users (name, surname, username, password, email) VALUES ('%s', '%s', '%s', '$password', '%s')", mysqli_real_escape_string($link, $name), mysqli_real_escape_string($link, $surname), mysqli_real_escape_string($username), mysqli_real_escape_string($link, $email));

if(mysqli_query($link, $query)){
    $response = array("return" => true);
} else {
    $response = array("return" => false, "message" => "Napaka pri registraciji");
}

echo json_encode($response);