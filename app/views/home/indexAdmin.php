<!DOCTYPE HTML>
<?php require_once '../app/views/templates/header.php'?>

	<h1>Hello <?=$_SESSION['username']?>.</h1>  
	<h1>You are in, the Date and Time: <?=date("Y/m/d")?>  </h1> 
	<h1>Time is <?=date("h/i")?></h1>   
	<br/>
	<a href="/remind/createRem">Reminders!</a>
	<br/>
	<a href="/Reports/mostReminders">Most user Reminders!</a>
	<br/>
	<a href="/Reports/remindersInDate">Find Reminders in a spacific date!</a>
	<br/>
	<a href="/Reports/totalLogByUser">Find total attempts by username!</a>

<?php require_once '../app/views/templates/footerPublic.php' ?>
<?php require_once '../app/views/templates/footer.php' ?>

