<!DOCTYPE HTML>
<?php require_once '../app/views/templates/header.php'?>

	<h1>Hello <?=$_SESSION['username']?>.</h1>  
	<h1>You are in, the Date and Time: <?=date("Y/m/d")?>  </h1> 
	<h1>Time is <?=date("h/i")?></h1> 
	<br/>
	<a href="/remind/createRem">Reminders!</a>
	<br/>
	<a href="/PFile/profileIndex">Profile!</a>
	<br/>
	<a href="/API/export">Profile!</a>

<?php require_once '../app/views/templates/footerPublic.php' ?>
<?php require_once '../app/views/templates/footer.php' ?>

