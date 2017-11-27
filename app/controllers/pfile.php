<?php

class PFile extends Controller {
	
    public function profileIndex() {	
    	$user = $this->model('User');
        $user->getUser($_SESSION['username']);

    	$user->addProfile($_SESSION['username']);

    	$this->view('profiles/indexProfile');
    }

     public function updateprofile() {
        $user = $this->model('User');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user->birthday = $_POST['birthday'];
            $user->phone = $_POST['phone'];
            $user->fname = $_POST['firstname'];
            $user->lname = $_POST['lastname'];
            $user->email = $_POST['email'];

            $today = date("Y-m-d");
            $diff = date_diff(date_create($user->birthday), date_create($today));
            if($diff->format('%y') < 18){
                echo "<script> alert('Age must be at least 18 years old!'); </script>";
                $this->view('profiles/indexProfile', $user);
                die;
            }

            $user->updateProfile();
            echo "<script> alert('Profile is updated!'); </script>";
            $this->view('home');
            die;
        } else {
            $this->view('profiles/indexProfile', $user);
            die;
        }
    }

}