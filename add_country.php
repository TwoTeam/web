<?php

include_once 'session.php';

if ($_POST) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $code = mysqli_real_escape_string($link, $_POST['code']);

    if (!empty($name) && !empty($code)) {
        $sql = mysqli_query($link, sprintf("SELECT * FROM countries WHERE name = '%s'", $name));
        $country = mysqli_fetch_assoc($sql);
        $count = mysqli_num_rows($sql);

        if ($count > 0) {
            echo 'error|Država <b>'.$name.'</b> že obstaja!';
            die();
        } else {
            $sql2 = sprintf("INSERT INTO countries (name, code) VALUES ('%s', '%s')", $name, strtoupper($code));
            if (mysqli_query($link, $sql2)) {
                echo 'success|Dela';
                die();
            } else {
                echo 'error|Napaka pri dodajanju države!';
                die();
            }
            
        }
    } else {
        echo 'error|Prosimo vnesite vse podatke o državi!';
        die();
    }
}
?>