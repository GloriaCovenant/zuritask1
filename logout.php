<?php

session_start();
session_destroy();

require("config.php");

header("Location: " .$config_basedir);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<a href="create.php">create courses </a>;, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="create.php">create courses </a>;
</body>
</html>

