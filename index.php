<?php

require_once("header.php");
require("config.php");


$sql = "SELECT * FROM courses";
    
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
// echo $result;
// echo "<h2><a href='viewentry.php?id=" 
//     . $row['id']  
//     ."'>" 
//     . $row['title'] . 
//     "</a></h2><br>";
// echo "<i>In <a href='viewcat.php?id=" 
//     . $row['cat_id'] 
//     ."'>" 
//     . $row['category'] 
//     ."</a> - Posted on " 
//     . date("F d, Y h:i:s", strtotime($row['dateposted'])) 
//     ."</i>";

// if(isset($_SESSION['USERNAME']) == TRUE){
//     echo "[<a href='updateentry.php?id=" . $row['id'] . "'>edit</a>]";
// }

echo "<p>";
echo nl2br($row['title']);
echo "</p>";

echo "<p>";
$row_id = (int) $row['id'];

// var_dump($row_id);

// $commsql = "SELECT comments.name FROM comments WHERE blog_id = 1 ORDER BY dateposted;";

// $commresult = mysqli_query($db, $commsql);


// $numrows_comm = mysqli_num_rows($commresult);
// if($numrows_comm == 0){
    // echo "<p>No comments.</p>";
// }
// else{
    // echo "(<strong>" . $numrows_comm . "</strong>) comments: ";
    // $i = 1;
    // while($commrow = mysqli_fetch_assoc($commresult)){
    //     echo "<a href='viewentry.php?id=" . $row['id']
    //     ."#comment" . $i
    //     ."'> "
    //     . $commrow['name'] . ", </a> ";
    //     $i++;
    // }
// }
// echo "</p>";
// $prevsql = "SELECT entries.*, categories.category FROM entries, categories
//     WHERE entries.cat_id = categories.id
//     ORDER BY dateposted DESC
//     LIMIT 1, 5;";
// $prevresult = mysqli_query($db, $prevsql);
// $numrows_prev = mysqli_num_rows($prevresult);

// if($numrows_prev == 0){
//     echo "<p>No previous entries.</p>";
// }
// else {
//     echo "<ul>";

    // while ($prevrow = mysqli_fetch_assoc($prevresult)){
    //     echo "<li><a href='viewentry.php?id="
    //     . $prevrow['id'] . "'>" . $prevrow ['subject']
    //     . "</a></li>";
    // }
// }

// echo "</ul>";


require("footer.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="create.php">create courses </a>;
</body>
</html>