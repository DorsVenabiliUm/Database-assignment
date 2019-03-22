<?php
require_once "config.php";
    
// Prepare a select statement
$sql = "SELECT * FROM companies WHERE id = " . $_GET["id"];
    
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
} else{
    echo "Oops! Something went wrong. Please try again later.";
}
mysqli_free_result($result);     
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
</head>
<body>
    <div>
        <h1>View Record</h1>
    </div>
    <div>
        <label>Name: </label>
        <?php echo $row["name"]; ?>
    </div>
    <div>
        <label>Address: </label>
        <?php echo $row["address"]; ?>
    </div>
    <p><a href="index.php">Back</a></p>
</body>
</html>
