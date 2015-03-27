<?php
include_once 'database.php';
$lokacija = $_POST['lokacija'];

$lokacija = substr($lokacija, 1, -1);
$lokacija = explode(', ', $lokacija);

$dolzina = $lokacija[0];
$sirina = $lokacija[1];

mysqli_query($link, "INSERT INTO places_geo (dolzina, sirina, naslov) VALUES ('$dolzina', '$sirina', NULL)");

echo 'success|Dolžina: '.$dolzina.'<br />Širina: '.$sirina;
die();
?>