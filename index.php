<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <div>
        <h2>Complany list</h2>
        <a href="create.php">Add New Company</a>
    </div>
    <?php
        // Include config file
        require_once "config.php";
                   
        // query all the company records
        $sql = "SELECT * FROM companies";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Name</th>";
                echo "<th>Address</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>";
                    echo "<a href='read.php?id=". $row['id'] ."'>View</a> ";
                    echo "<a href='update.php?id=". $row['id'] ."'>Update</a> ";
                    echo "<a href='delete.php?id=". $row['id'] ."'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";                            
                echo "</table>";
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "<p><em>No records were found.</em></p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
 
       // Close connection
       mysqli_close($conn);
    ?>
</body>
</html>
