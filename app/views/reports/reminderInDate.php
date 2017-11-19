<!DOCTYPE HTML>
<?php require_once '../app/views/templates/header.php'?>

<form method="post" action="/login/register">
		<h3>Date from:</h3>
		<input type="text" name="dateFrom"><br/>
		<h3>Date to</h3>
		<input type="text" name="dateTo"><br/>
		<button type="submit" > Submit </button>
		<br/>
		<br/>
</form>
<h1>The reminders in date range is <?= print_r($_SESSION['totalRemInDate']) ?></h1>