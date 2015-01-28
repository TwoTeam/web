<?php

include_once 'database.php';

ob_start();
session_start();

function user_data($user_id, $link) {
    $user_id = (int) $user_id;

    $sql = mysqli_query($link, "SELECT * FROM users WHERE id = $user_id");
    $data = mysqli_fetch_assoc($sql);

    return $data;
}
?>