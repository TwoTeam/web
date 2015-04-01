<?php

include_once '../database.php';

$username = $_REQUEST["username"];
$name = $_REQUEST["name"];
$surname = $_REQUEST["surname"];
$email = $_REQUEST["email"];
$password = sha1($_REQUEST["password"]);

if (!empty($username) && !empty($name) && !empty($surname) && !empty($email) && !empty($password)) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = sprintf("INSERT INTO users (name, surname, username, password, email) VALUES ('%s', '%s', '%s', '$password', '%s')", mysqli_real_escape_string($link, $name), mysqli_real_escape_string($link, $surname), mysqli_real_escape_string($link, $username), mysqli_real_escape_string($link, $email));
        if (mysqli_query($link, $query)) {
            $response["result"][] = array("response" => true, "message" => "Registracija uspešna!");
        } else {
            if (mysql_errno($link) == 1052) {
                $response["result"][] = array("response" => false, "message" => "Napaka pri registraciji! Uporabnik s takšnim uporabniškim e-naslovom že obstaja");
            } else {
                $response["result"][] = array("response" => false, "message" => "Napaka pri registraciji");
            }
        }
    } else {
        $response["result"][] = array("response" => false, "message" => "E-naslov ni veljaven!");
    }
} else {
    $response["result"][] = array("response" => false, "message" => "Napaka podatkov!");
}

echo json_encode($response);
