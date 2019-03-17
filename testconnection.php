<html>
<body>
<body background = "zelda.jpg">
<h1 style="font-family:verdana;color:red">My First Web Page</h1>
<ul>
<li>ciscxxx</li>
<li>cisc123</li>
</ul>
<form>
<p>Please select a subcommittee<br>
	<select name="subcom">
		<option value = "">--select subcommittee--</option>
		<option value = "committee">committee1</option>
	</select>
</p>
</form>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=committee',"root","");
$sql = "SELECT first_name,last_name,id FROM people";
$stmt = $pdo->prepare($sql);
$stmt->execute();
echo "<table border='4'>";
echo "<table><tr><th>Firstname</th><th>Lastname</th><th>id</th></tr>";
while($row = $stmt->fetch()){
	echo"<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["id"]."</td></tr>";
}
?>
<a href = "https://www.cs.queensu.ca"> click into cs webpage</a>
<?php
$thesubcommittee = $_POST['subcom'];
$sql1 = "SELECT id,chair_id,name FROM sub_committee WHERE name = $thesubcommittee";
$stmt = $pdo->prepare($sql1);
$stmt->execute();
echo "<table border='4'>";
echo "<table><tr><th>id</th><th>chair_id</th><th>name</th></tr>";
while($row = $stmt->fetch()){
	echo"<tr><td>".$row["id"]."</td><td>".$row["chair_id"]."</td><td>".$row["name"]."</td></tr>";
}
?>
</table>
</body>
</html>