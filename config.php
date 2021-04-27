<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbdatabase = "zuricrud";

$config_blogname = "CRUD APP";

$config_author = "G WORLDS";

$config_basedir = "http://127.0.0.1/zuritask1";

$db = mysqli_connect($dbhost, $dbuser, $dbpassword);
mysqli_select_db($db, $dbdatabase);

?>