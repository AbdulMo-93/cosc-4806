<!DOCTYPE HTML>
<?php require_once '../app/views/templates/headerPublic.php' ?>
<html>
<body>
	<form 
	method="post" action="/login/index">
	<h1>Username:<br/></h1>
	<input type="text" name="username"><br/>
	<h1> Password:<br/></h1>
	<input type="password" name="password"><br/>
	<br/>		
	<input type="submit" value="Login">
	<br/>
	<br/>
	<a href="/Reports/attempts"> Report </a>
	<br/>
	<br/>
	<a href="/login/register"> Create Account </a>
	</form>
</body>
</html>
<?php require_once '../app/views/templates/footer.php' ?>
