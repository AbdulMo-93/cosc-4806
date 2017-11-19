<!DOCTYPE HTML>
<?php require_once '../app/views/templates/header.php'?>

<form method="post" action="/Reports/totalLogByUser">
		<h3>Username:</h3>
		<input type="text" name="username"><br/>
		<br/>
		<button type="submit" > Submit </button>
		<br/>
		<br/>
</form>

<h1>Total attempts for <?=$_POST['username']?> is <?=$_SESSION['attTotalByUser']?></h1>