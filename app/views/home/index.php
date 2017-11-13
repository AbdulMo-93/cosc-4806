<!DOCTYPE HTML>
<?php require_once '../app/views/templates/header.php'?>
<br/>
<br/>
<br/>
	<h1>Hello <?=$_SESSION['username']?>.</h1>  
	<h1>You are in, the Date and Time: <?=date("Y/m/d")?>  </h1> 
	<h1>Time is <?=date("h/i")?></h1>   
	<br/>
	<a href="/remind/createRem">Reminders!</a>
<?php require_once '../app/views/templates/footerPublic.php' ?>
<?php require_once '../app/views/templates/footer.php' ?>

