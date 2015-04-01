<?php

include_once "database.php";

$pass1 = $_GET['password1'];
$pass2 = $_GET['password2'];
$hash = $_GET['hash'];

if (!empty($pass1) && !empty($pass2)) {
    $pass = sha1($pass1);
    $query = sprintf("UPDATE users SET password='$pass',hash=NULL WHERE hash='$hash'");
    if (mysqli_query($link, $query)) {
        //echo "#uspelo";
        echo "IF2";

        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }

        header("Location: index.php");
    } else {
        header("Location: changepassword.php?hash=$hash");
    }
} else {
    header("Location: changepassword.php?hash=$hash");
}
?>