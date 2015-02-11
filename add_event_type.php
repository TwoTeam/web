<?php

include_once 'session.php';

if ($_POST) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $desc = mysqli_real_escape_string($link, $_POST['desc']);

    if (!empty($name) && !empty($desc)) {
        $sql = mysqli_query($link, sprintf("SELECT * FROM genres WHERE name = '%s'", $name));
        $genre = mysqli_fetch_assoc($sql);
        $count = mysqli_num_rows($sql);

        if ($count > 0) {
            echo 'error|Vrsta dogodka <b>'.$name.'</b> že obstaja!';
            die();
        } else {
            $sql2 = sprintf("INSERT INTO genres (name, description) VALUES ('%s', '%s')", $name, $desc);
            if (mysqli_query($link, $sql2)) {
                echo 'success|Dela';
                die();
            } else {
                echo 'error|Napaka pri dodajanju vrste dogodka!';
                die();
            }
            
        }
    } else {
        echo 'error|Prosimo vnesite vse podatke o vrsti dogodka!';
        die();
    }
}
?>