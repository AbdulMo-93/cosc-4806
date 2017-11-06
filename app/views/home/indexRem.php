<?php require_once '../app/views/templates/header.php'?>
<br/>
<br/>
<br/>
<h2>Reminder Page</h2>
<table class='table table-striped table-condensed'>
	<tr>
		<th>Subject</th>
		<th>description</th>
		<th>Action</th>
	</tr>
<html>
<body>
  <br/>Creating Reminder:
	<br/>
	<form method="post" action="/remind/create">
		subjects:
		<input type="text" name="subjects">
		Description:
		<input type="text" name="description">
		<button type="submit" > Submit </button>
		<br/>
		<br/>
	</form>
</body>
</html>
<a href="/remind/index">Update</a>
    <?php foreach ($data['list'] as $list){ ?>
        <tr>
            <td><?=$list['subjects']?></td>
            <td><?=$list['Description']?></td>
			<td><a href="/remind/remove/<?=$list['Id']?>">Remove</a> |
				<a href="/remind/update/<?=$list['Id']?>">Update</a>
			</td>
        </tr>
          <?php }?>
</table>