<?php

include_once 'session.php';

if ($_POST) {
    $genre = mysqli_real_escape_string($link, $_POST['genre']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $start = mysqli_real_escape_string($link, $_POST['start']);
    $end = mysqli_real_escape_string($link, $_POST['end']);
    $desc = mysqli_real_escape_string($link, $_POST['desc']);
    
    $start_date = dateconvertion($start).'<br />';
    $end_date = dateconvertion($end).'<br />';

    if (!empty($genre) && !empty($name) && !empty($address) && !empty($start) && !empty($desc) && !empty($desc)) {
        $sql = mysqli_query($link, sprintf("SELECT * FROM events WHERE name = '%s'", $name));
        $event = mysqli_fetch_assoc($sql);
        $count = mysqli_num_rows($sql);

        if ($count > 0) {
            echo 'error|Dogodek <b>'.$name.'</b> že obstaja!';
            die();
        } else {
            $sql2 = sprintf("INSERT INTO events (genre_id, place_id, name, event_start, event_end, description) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", $genre, $address, $name, $start_date, $end_date, $desc);
            if (mysqli_query($link, $sql2)) {
                echo 'success|Dela';
                die();
            } else {
                echo 'error|Napaka pri dodajanju dogodka!';
                die();
            }
            
        }
    } else {
        echo 'error|Prosimo vnesite vse podatke o dogodku!';
        die();
    }
}
?>