<?php

include_once '../database.php';

$username = $_REQUEST["username"];
$name = $_REQUEST["name"];
$surname = $_REQUEST["surname"];
$email = $_REQUEST["email"];
$password = sha1($_REQUEST["password"]);

if (!empty($username) && !empty($name) && !empty($surname) && !empty($email) && !empty($password)) {
    $query = sprintf("INSERT INTO users (name, surname, username, password, email) VALUES ('%s', '%s', '%s', '$password', '%s')", mysqli_real_escape_string($link, $name), mysqli_real_escape_string($link, $surname), mysqli_real_escape_string($link, $username), mysqli_real_escape_string($link, $email));
    if (mysqli_query($link, $query)) {
        $response = array("response" => true);
    } else {
        $response = array("response" => false, "message" => "Napaka pri registraciji");
    }
} else {
    $response = array("response" => false, "message" => "Napaka podatkov!");
}

echo json_encode($response);
