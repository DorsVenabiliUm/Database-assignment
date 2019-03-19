<html>
<body>
<?php
$givenName = $_POST["first_name"];                      
$surname = $_POST["last_name"];
$id = $_POST["id"];
$employment = $_POST["newtype"];

$pdo = new PDO('mysql:host=localhost;dbname=committee',"root","");
$sql1 = "Insert into people(first_name,last_name,a_id) 
		 Values(?,?,?);";
	if ($employment = "student"){
		$stmt = $pdo->prepare($sql1);
		$stmt->execute([$givenName,$surname,$id]);
	}
	
?>		 