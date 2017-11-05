<?php require_once '../app/views/templates/header.php'?>

<h2>Update Reminder</h2>


<form method="post" action="/remind/update">

Subject:
<input type="text" name= "newSub" >
Description:
<input type="text" name= "newDes" >

<button type="submit"> Update </button>

</form>