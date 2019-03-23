<?php
 
/* establish connection to database */
$conn = mysqli_connect("localhost", "root", "", "demo");
 
/* check connection to see if the connection has been established */
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
