<?php

class Login extends Controller {
    public function index() {
        $user = $this->model('User');

        if (isset($_POST['username'])) {
            $user->username = $_POST['username'];
        }

        if (isset($_POST['password'])) {
            $user->password = $_POST['password'];
        }
		if (isset($_POST['FirstName'])) {
            $user->fname = $_POST['FirstName'];
        }
		 if (isset($_POST['LastName'])) {
            $user->lname = $_POST['LastName'];
        }
		 if (isset($_POST['Email'])) {
            $user->email = $_POST['Email'];
        }
        $user->authenticate();

        if ($user->auth == TRUE) {
            $_SESSION['auth'] = true;
        }
       header('Location: /home');
    }
	
	public function register () {
		
		$user = $this->model('User');
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$fname  = $_POST['firstName'];
			$lname = $_POST['lastName'];
			$email = $_POST['email'];
						
			$user->register($username, $password, $fname, $lname, $email);
		}
		
		$this->view('home/register');
	}
}
