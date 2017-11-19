<?php

class Reports extends Controller {
    public function mostReminders() {
		$user = $this->model('User');
		if($_SESSION['Permission']!=3){
			header('Location: /home');
		}

		$db = db_connect();
        $statement = $db->prepare(" SELECT Username, COUNT(Username) as max FROM reminders GROUP BY Username order by max desc limit 1;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['mostReminder'] = $rows[0]['max'];
        $_SESSION['mostUsernameReminder'] = $rows[0]['Username'];
		$this->view('reports/mostRem');
    }

    public function remindersInDate() {
		$user = $this->model('User');
		if($_SESSION['Permission']!=3){
			header('Location: /home');
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$dateFrom = $_POST['dateFrom'];
			$dateTo = $_POST['dateTo'];

			$db = db_connect();
	        $statement = $db->prepare("SELECT rc_type FROM reminders WHERE start_date >= :start_date AND end_date <= :end_date;");
	        $statement->bindValue(':start_date', $dateFrom);
	        $statement->bindValue(':end_date', $dateTo);
	        $statement->execute();
	        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
	        $_SESSION['totalRemInDate'] = $rows;
	    }
		$this->view('reports/reminderInDate');
    }

    public function totalLogByUser() {
		$user = $this->model('User');
		if($_SESSION['Permission']!=3){
			header('Location: /home');
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$userInput = $_POST['Username'];
			$db = db_connect();
	        $statement = $db->prepare(" SELECT Attempts FROM log WHERE username =:username;");
	        $statement->bindValue(':username', $userInput);
	        $statement->execute();
	        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
	        $_SESSION['attTotalByUser'] = $rows[0]['Attempts'];


	    }
		$this->view('reports/totalLoginByUsers');
    }
}