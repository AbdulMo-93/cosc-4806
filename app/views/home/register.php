<!DOCTYPE HTML>
<?php require_once '../app/views/templates/headerPublic.php' ?>
<html>
<body>
  <br/>
	Creating Account<br/>
	  <br/>
	<form method="post" action="/login/register">
		<h3>Username:</h3>
		<input type="text" name="username"><br/>
		<h3>Password</h3>
		<input type="password" name="password"><br/>
		<h3>First Name:</h3>
		<input type="text" name="firstName"><br/>
		<h3>last Name:</h3>
		<input type="text" name="lastName"><br/>
		<h3>E-mail:</h3>
		<input type="text" name="email"><br/>
		<br/>
		<button type="submit" > Submit </button>		  <br/>
		<br/>
	</form>
</body>
</html>
		<a href="/login/index"> Back to login page! </a>    
