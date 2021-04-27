<?php
// Include config file
// require_once "config.php";
 
// Define variables and initialize with empty values
$user_id = $title = $level = "";
$user_id_err = $title_err = $level_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate username
    $input_username = trim($_POST["user_id"]);
    if(empty($input_username)){
        $user_id_err = "Please enter a username.";
    } elseif(!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $user_id_err = "Please enter a valid username.";
    } else{
        $user_id = $input_username;
    }
    
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter your title.";     
    } else{
        $title = $title;
    }
    
    // Validate level
    $input_level = trim($_POST["level"]);
    if(empty($input_level)){
        $level_err = "Please enter your current level.";     
    } elseif(!ctype_digit($input_level)){
        $level_err = "Please enter a positive integer value.";
    } else{
        $level = $input_level;
    }
    
    // Check input errors before inserting in database
    if(empty($user_id_err) && empty($title_err) && empty($level_err)){
        // Prepare an update statement
        $sql = "UPDATE courses SET user_id=?, title=?, level=? WHERE id=?";
         
        if($stmt = mysqli_prepare($db , $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_user_id, $param_title, $param_level);
            
            // Set parameters
            $param_user_id = $user_id;
            $param_title = $title;
            $param_level = $level;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($db );
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM courses WHERE id = ?";
        if($stmt = mysqli_prepare($db , $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_user_id);
            
            // Set parameters
            $param_user_id = $user_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $user_id = $row["user_id"];
                    $title = $row["title"];
                    $level = $row["level"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        // mysqli_close($db );
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>username</label>
                            <input type="text" username="username" class="form-control <?php echo (!empty($user_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_id; ?>">
                            <span class="invalid-feedback"><?php echo $user_id_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>title</label>
                            <textarea username="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"><?php echo $title; ?></textarea>
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <input type="text" username="level" class="form-control <?php echo (!empty($level_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $level; ?>">
                            <span class="invalid-feedback"><?php echo $level_err;?></span>
                        </div>
                        <input type="hidden" username="id" value="<?php echo $user_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>