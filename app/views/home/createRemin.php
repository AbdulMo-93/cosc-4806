<!DOCTYPE HTML>

<?php require_once '../app/views/templates/headerPublic.php' ?>

<html>
<body>
  <br/>Creating Reminder<br/>
	<br/>
	<form method="post" action="/remind/create">
		subjects:
		<input type="text" name="subjects"><br/>
		Description:
		<input type="text" name="description"><br/>
		<br/>
		<button type="submit" > Submit </button>
		<br/>
		<br/>
	</form>
</body>
</html>

    <?php require_once '../app/views/templates/footer.php' ?>
