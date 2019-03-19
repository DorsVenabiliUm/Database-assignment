Add a new attendee:
<form action="insert_attendee.php" method="post">
<p>First name:</p>
<input type="text" name="first_name">
<br>
<p>Last name:</p>
<input type="text" name="last_name"><br>
<p>id:</p>
<input type="text" name="id"><br><br>
	<select name = "newtype">
		<option value = "">--select your employment--</option>
		<option value ="student">student</option>
		<option value ="professor">professor</option>
		<option value ="sponsor">sponsor</option>
	</select>
<input type="submit">
</form> 