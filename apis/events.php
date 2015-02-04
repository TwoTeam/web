<?php
include_once '../database.php';

$user = $_POST["user_id"];

$query = "SELECT * FROM events WHERE deleted = 0";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $response[] = $row;
    }
} else {
    $response = array("message" => "Trenutno ni dodanih dogodkov!");
}

echo json_encode($response);
