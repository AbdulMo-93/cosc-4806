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
		<input type="text" name="firstName"><br/>
		last Name:<br/>
		<input type="text" name="lastName"><br/>
		E-mail:<br/>
		<input type="text" name="email"><br/>
		<br/>
		<button type="submit" > Submit </button>		  <br/>
		<br/>
	</form>
</body>
</html>
			</form>
			<a href="/login/index"> Back to login page! </a>
        </div>
    </div>

    <?php require_once '../app/views/templates/footer.php' ?>
