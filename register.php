<?php 
// session_start();

require("config.php");

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
// $error = 0;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // var_dump($_POST);
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your Username";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                }
                else{
                    $username = trim($_POST["username"]);
                }
            }
            else{
                echo "OOps! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }


    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    }
    elseif(strlen(trim($_POST["password"])) < 3){
        $password_err = "Password must have atleast 6 characters.";
    }
    else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($db, $sql)){
            var_dump(mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password));

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            // var_dump($sql);
            var_dump($param_username);
            var_dump($param_password);

            if(mysqli_stmt_execute($stmt)){
                echo "Sign up successful";
                header("location: login.php");
            }
            else{
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($db);
}
require("header.php");
?>

<div class="wrapper w-50 mx-auto">
    <h2>Sign up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo(!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label for="Confirm Password">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>

</div>
