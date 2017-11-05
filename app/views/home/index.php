<!DOCTYPE HTML>
<?php require_once '../app/views/templates/header.php'?>
<br/>
<br/>
<br/>
	<h1>Hello</h1> <?php $_SESSION['username'];?> 
	<h1>You are in,  Date is </h1> <?php date("Y/m/d");?> 
	<h1>Time is </h1>  <?php date("h/i/s");?> 
	<br/>
	<a href="/remind/createRem">Reminders!</a>
<?php require_once '../app/views/templates/footer.php' ?>
