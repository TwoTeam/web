<?php
include_once '../database.php';

$user = $_REQUEST["user_id"];

$query = "SELECT * FROM events WHERE deleted = 0";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $response["result"][] = $row;
    }
} else {
    $response["result"][] = array("response" => false, "message" => "Trenutno ni dodanih dogodkov!");
}

echo json_encode($response);
