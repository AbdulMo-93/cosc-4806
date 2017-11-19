<?php
class Home extends Controller {

    public function index($name = '') {		
        $user = $this->model('User');
		if($_SESSION['Permission'] == 3) {
          	$this->view('home/indexAdmin', ['message' => $message]);
        }else{
			$this->view('home/index', ['message' => $message]);
        }
    }

    public function login($name = '') {
        $this->view('home/login');
    }

}
