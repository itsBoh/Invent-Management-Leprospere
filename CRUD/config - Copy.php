<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'tugasuas_user');
define('DB_PASSWORD', '4X~-f#IQ?2L@');
define('DB_NAME', 'tugasuas_lepros');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>