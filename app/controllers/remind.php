<?php

class Remind extends Controller {
	
    public function index($id = '') {	

        $user = $this->model('User');
		$list = $user->get_reminders();
		
		$this->view('home/indexRem', ['list' => $list]);
    }

	public function update($id='') {
		
		$user = $this->model('User');
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$subjects = $_POST['newSub'];
			$description = $_POST['newDes'];
         	$user->update($id,$subjects, $description);
         	header('Location:/remind');
		}else{
			$this->view('home/update' );
		}		
    }

	public function remove($id = '') {
		
		$user = $this->model('User');
		$user->removeItem($id);
		header('Location:/remind');
    }
	
	public function create() {
		$user = $this->model('User');
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$subjects = $_POST['subjects'];
			$description = $_POST['description'];
			$user->addToTable( $_SESSION['username'] , $subjects, $description);
		}
        $this->view('/home/indexRem');
    }
}