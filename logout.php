<?php
session_start();
session_destroy();

setcookie('cookname', '', time() - 3600, "/");
setcookie('cookpass', '', time() - 3600, "/");
setcookie('check', '0', time() - 3600, "/");

header('Location: index.php');
die();
?>