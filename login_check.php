<?php
include_once 'database.php';
include_once 'session.php';

if ($_POST) {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = sha1(mysqli_real_escape_string($link, $_POST['password']));
    
    $sql = mysqli_query($link, sprintf("SELECT * FROM users WHERE email = '%s' AND password = '%s'", $email, $password));
    $user = mysqli_fetch_assoc($sql);
    $count = mysqli_num_rows($sql);
    
    if ($count == 1) {
        $_SESSION['user_id'] = $user['id'];
        echo 'ok';
    } else {
        echo '!!!';
    }
}
?>