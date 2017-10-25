<?php

class User {

    public $username;
    public $password;
    public $auth = false;
	public $fname;
	public $lname;
	public $email;

    public function __construct() {
        
    }

    public function authenticate() {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		 
		$db = db_connect();
        $statement = $db->prepare("select * from users
                                WHERE Username = :name;");
        $statement->bindValue(':name', $this->username);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		$statement2 = $db->prepare("select * from users
                                WHERE Password = :pass;");
		$statement2->bindValue(':pass', $this->password);
        $statement2->execute();
        $rows2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
		
		//print_r ($rows2); die;
		if (!empty($rows) && !empty($rows2)) {
			$this->auth = true;
			$_SESSION['username'] = $rows[0]['username'];
			$_SESSION['password'] = $rows[0]['password'];
		}
    }
	
	public function register ($username, $password, $fname, $lname, $email) {
		
		$hashPass = password_hash($password, PASSWORD_DEFAULT);
		$db = db_connect();
		
		$statement = $db->prepare("INSERT INTO users (Username, Password, FirstName, LastName, Email)"
		. "VALUES (:username, :password, :firstName, :lastName, :email ); ");
			
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $hashPass);
		$statement->bindValue(':firstName', $fname);
		$statement->bindValue(':lastName', $lname);
		$statement->bindValue(':email', $email);

        $statement->execute();
	
	}

}
