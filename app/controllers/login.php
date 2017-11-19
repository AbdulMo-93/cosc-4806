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
          //check if admin
           $db = db_connect();
           $statement = $db->prepare(" SELECT Permission FROM users WHERE username =:username;");
           $statement->bindValue(':username', $_SESSION['username']);
           $statement->execute();
           $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
           $_SESSION['Permission'] = $rows[0]['Permission'];

          // last login time
           $db = db_connect();
           $statement = $db->prepare(" SELECT TimeLogin FROM log WHERE username =:username;");
           $statement->bindValue(':username', $_SESSION['username']);
           $statement->execute();
           $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
           $_SESSION['lastLogTime'] = $rows[0]['TimeLogin'];

          // total day login attempts
           $curr = date('Y-m-d');
           $start = $curr . ' 00:00:00';
           $end = $curr . ' 23:59:59';
           $db = db_connect();
           $statement = $db->prepare(" SELECT sum(Attempts) as attempt from log where :start < TimeLogin AND TimeLogin < :end");
           $statement->bindValue(':start', $start);
           $statement->bindValue(':end', $end);
           $statement->execute();
           $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
           $attempt = 0;
          
           foreach($rows as $row){
              $attempt += (int)$row['attempt'];
           }
           $_SESSION['totalAttempts'] = $attempt;

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
