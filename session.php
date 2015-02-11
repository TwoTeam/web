<?php

include_once 'database.php';

ob_start();
session_start();

if (!empty($_COOKIE['cookname']) && !empty($_COOKIE['cookpass']) && ($_SESSION['logged'] != 1) && $_COOKIE['check'] == 1 && $_SERVER["REQUEST_URI"] != '/web/login.php') {
    autoLogin($_COOKIE['cookname'], $_COOKIE['cookpass'], $link);
}

function user_data($link, $user_id) {
    $user_id = (int) $user_id;

    $sql = mysqli_query($link, "SELECT * FROM users WHERE id = $user_id");
    $data = mysqli_fetch_assoc($sql);

    return $data;
}

function autoLogin($email, $password, $link) {
    $sql = mysqli_query($link, sprintf("SELECT * FROM users WHERE email = '%s' AND password = '%s'", $email, $password));
    $user = mysqli_fetch_assoc($sql);
    $count = mysqli_num_rows($sql);

    if ($count == 1) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['logged'] = 1;
        header('Location: admin.php');
        die();
    } else {
        header('Location: login.php');
        die();
    }
}

function dateconvertion($date) {
    $date = explode(' ob ', $date);

    $date_conv = strtotime(str_replace('. ', '-', implode(' ', $date)));
    return date('Y-m-d H:i', $date_conv);
}

function dateToHuman($date) {
    $date_conv = strtotime($date);
    return date('d. m. Y - H:i', $date_conv);
}
?>