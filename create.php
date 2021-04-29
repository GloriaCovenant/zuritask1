<?php
// Include config file
require("config.php");
 
// Define variables and initialize with empty values
$user_id = $title = $level = "";
$user_id_err = $title_err = $level_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_user_id = trim($_POST["user_id"]);
    if(empty($input_user_id)){
        $user_id_err = "Please enter your Username.";
    } elseif(!filter_var($input_user_id, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $user_id_err = "Please enter a valid name.";
    } else{
        $user_id = $input_user_id ;
    }
    var_dump($input_user_id);
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter your Course title.";     
    } else{
        $title = $input_title;
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
        // Prepare an insert statement
        $sql = "INSERT INTO courses (user_id, title, level) VALUES (?, ?, ?)";
        // var_dump($level);
         
        if($stmt = mysqli_prepare($db , $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_user_id, $param_title, $param_level);
        
            // Set parameters
            $param_user_id = $user_id;
            $param_title = $title;
            $param_level = $level;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                    header("location: read.php");
                    echo "course succcessfully created";
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create title</title>
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
                    <h2 class="mt-5">Create Course</h2>
                    <p>Please fill in your course</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="user_id" class="form-control <?php echo (!empty($user_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_id; ?>">
                            <span class="invalid-feedback"><?php echo $user_id_err;?></span>
                           
                        </div>
                        <div class="form-group">
                            <label>Course title</label>
                            <textarea name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"><?php echo $title; ?></textarea>
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <input type="text" name="level" class="form-control <?php echo (!empty($level_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $level; ?>">
                            <span class="invalid-feedback"><?php echo $level_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                        
                    </form>
                    
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>