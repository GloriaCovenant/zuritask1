<?php
session_start();
require("config.php");

// $db = mysqli_connect($dbhost, $dbuser, $dbpassword);
// mysqli_select_db($db, $dbdatabase);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config_blogname; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="header">
        <h1><?php echo $config_blogname; ?></h1>
        [<a href="home.php">Home</a>]
        <!-- [<a href="viewcat.php">Dashboard</a>] -->

        <?php
        // session_start();
        // var_dump($_SESSION);#
    //    require("login.php");
        if(isset($_SESSION["username"])){
            // var_dump($_SESSION["username"]);
            if("[<a href='login.php'>login</a>]"){
                echo "[<a href='logout.php'>logout</a>]";    
                // echo "----";
                // echo "[<a href='addentry.php'>add entry</a>]";
                // echo "[<a href='addcat.php'>add category</a>]";
            }            
        }
        else{
            // var_dump($_SESSION);
            echo "[<a href='login.php'>login</a>]";
        }

        
        ?>
        
        <!-- [<a href='logout.php'>logout</a>] -->
    </div>
    <div id="main">
   