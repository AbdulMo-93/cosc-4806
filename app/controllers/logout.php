<?php
 	$att = 1;
	$db = db_connect();
	$statement = $db->prepare("select * from log
                        WHERE Username = :name;");
	$statement->bindValue(':name',$_SESSION['username']);
	$statement->execute();
	$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

	if($rows){
		$att_num_data = $rows[0]['Attempts'];
		//echo $att_num_data; die;
		$att = $att_num_data + 1;
        $statement = $db->prepare("UPDATE log SET Attempts = :att WHERE Username = :user");
        $statement->bindValue(':user', $_SESSION['username']);
        $statement->bindValue(':att', $att);
        $statement->execute();
	}else{
		$statement1 = $db->prepare("INSERT INTO log (Username, Attempts)"
		. "VALUES (:username, :attempts); ");
		$statement1->bindValue(':username',$_SESSION['username']);
		$statement1->bindValue(':attempts',	$att);
		$statement1->execute();
	}
session_destroy();
header ('location:/');

?> 