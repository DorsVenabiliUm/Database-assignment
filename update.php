<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = "";
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];

    // Prepare an update statement
    $sql = "UPDATE companies SET name=?, address=? WHERE id=?";

    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_address, $param_id);

        // Set parameters
        $param_name = $name;
        $param_address = $address;
        $param_id = $id;

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records updated successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
} else{
    // Check existence of id parameter before processing further
    // Prepare a select statement
    $id = $_GET["id"];
    $sql = "SELECT * FROM companies WHERE id = " . $id;

    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // Retrieve individual field value
            $name = $row["name"];
            $address = $row["address"];
        } else{
            header("location: error.php");
            exit();
    }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
</head>
<body>
    <div>
        <h2>Update Record</h2>
    </div>
    <p>Please edit the input values and submit to update the record.</p>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $address; ?>">
        </div>
       <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" value="Submit">
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
