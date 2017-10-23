<?php require_once '../app/views/templates/headerPublic.php' ?>
<html>
<body>
  <br/>
	Creating Account<br/>
	  <br/>
	<form method="post" action="/login/register">
		Username:<br/>
		<input type="text" name="username"><br/>
		Password<br/>
		<input type="password" name="password"><br/>
		First Name:<br/>
		<input type="text" name="FirstName"><br/>
		last Name:<br/>
		<input type="text" name="LastName"><br/>
		E-mail:<br/>
		<input type="text" name="Email"><br/>
		  <br/>
	</form>
</body>
</html>
			</form>
			<a href="/login/register"> Sign up here </a>
			<br/><br/>
			<a href="/login/index"> Back to login page! </a>
        </div>
    </div>

    <?php require_once '../app/views/templates/footer.php' ?>
