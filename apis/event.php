<?php
include_once '../database.php';
$event = (int) $_REQUEST["id"];

$query = "SELECT * FROM events WHERE id = $event";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 1) {
    $response = mysqli_fetch_array($result);
} else {
    $response = array("response" => false, "message" => "Napaka pri pridobivanju dogodka!");
}
echo json_encode($response);