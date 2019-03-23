<?php
// Include config file
require_once "config.php";
 
// initialize the variables
$name = $address = "";
 
// Processing form data when form is submitted
// There is no any validatio  has been done here. 
// We make an assumpation that all the data enerted is valid.
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the posted form data
    $name = $_POST["name"];
    $address = $_POST["address"];
   
    echo "name=" . $name . " address=" . $address;
    // Inserting the data into database
    $sql = "INSERT INTO companies (name, address) VALUES (?, ?)";
         
    if($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_name, $param_address);
            
        // Set parameters
        $param_name = $name;
        $param_address = $address;
            
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
          // Records created successfully. Redirect to landing page
          header("location: index.php");
          exit();
      } else{
        echo "Something went wrong. Please try again later.";
      }
    } 
         
    // Close statement
    mysqli_stmt_close($stmt);
}
    
// Close connection
mysqli_close($conn);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
</head>
<body>
    <div>
        <h2>Create Record</h2>
    </div>
    <p>Please fill this form and submit to add record to the database.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         <div>
             <label>Name</label>
             <input type="text" name="name">
         </div>
         <div>
         <label>Address</label>
             <input type="text" name="address"">
         </div>
         <input type="submit" value="Submit">
         <a href="index.php">Cancel</a>
    </form>
 </body>
</html>
