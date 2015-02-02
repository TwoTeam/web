<?php
include_once 'session.php';

if ($_POST) {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    if (!empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo 'error|Elektronski naslov ni veljaven!';
            die();
        } else {
            $password = sha1($password);

            $sql = mysqli_query($link, sprintf("SELECT * FROM users WHERE email = '%s' AND password = '%s'", $email, $password));
            $user = mysqli_fetch_assoc($sql);
            $count = mysqli_num_rows($sql);

            if ($count == 1) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged'] = 1;

                if ($_POST['remember'] == 1) {
                    setcookie('cookname', $email, time() + 60 * 60 * 24 * 100, '/');
                    setcookie('cookpass', $password, time() + 60 * 60 * 24 * 100, '/');
                    setcookie('check', 1, time() + 60 * 60 * 24 * 100, '/');
                }
                echo 'redirect|admin.php';
            } else {
                echo 'error|Napaka pri prijavi!';
            }
        }
    } else {
        echo 'error|Prosimo vnesite elektronski naslov in geslo!';
        die();
    }
}
?>