<?php
include_once '../database.php';
$cancel = $_GET["pass"];
$IsCorrect = 0;

$query = sprintf("SELECT * FROM users WHERE hash = '%s'", mysqli_real_escape_string($link, $cancel));
$query2 = sprintf("UPDATE users SET hash=0 WHERE hash = '%s'",mysqli_real_escape_string($link, $cancel));
$result = mysqli_query($link, $query);

if(mysqli_num_rows($result) == 1){
	$IsCorrect = 1;
	if(mysqli_query($link,$result2)){
		echo "Geslo ponastavljeno";
	}else{
		echo "Napaka";
	}
} else {
	$IsCorrect = 0;
}
?>