<?php require_once '../app/views/templates/headerPublic.php' ?>


<html>
<body>

	<form method="post" action="/login/index">
		Username:<br/>
		<input type="text" name="username"><br/>
		Password<br/>
		<input type="password" name="password1"><br/>
		<br/>		
		<input type="submit" value="Login">
		
	</form>
	<form method="post" action= "report.php">
		<br/>
		<input type="submit" value="Report">
		<br/>
	</form>
	<a href="/login/register"> Create Account </a>
</body>
</html>



    <?php require_once '../app/views/templates/footer.php' ?>
