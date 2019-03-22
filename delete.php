<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM companies WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $_POST["id"];
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
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
    <title>View Record</title>
</head>
<body>
    <div>
        <h1>Delete Record</h1>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         <div>
             <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
             <p>Are you sure you want to delete this record?</p><br>
             <p>
                 <input type="submit" value="Yes">
                 <a href="index.php">No</a>
             </p>
         </div>
    </form>
</body>
</html>
