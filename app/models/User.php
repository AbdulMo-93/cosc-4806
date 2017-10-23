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
                                WHERE Username = :name; AND Password = :pass;");
        $statement->bindValue(':name', $this->username);
		$statement->bindValue(':pass', $this->password);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		if ($rows) {
			$this->auth = true;
			$_SESSION['username'] = $rows[0]['username'];
			$_SESSION['password'] = $rows[0]['password'];
		}
    }
	
	public function register ($username, $password, $fname, $lname, $email) {
		$db = db_connect();
        $statement = $db->prepare("INSERT INTO users (Username,Password, First name, Last name, E-mail)"
                . " VALUES (:name, :pass, :fname, :lname, :email); ");
		$statement->bindValue(':name', $username);
		$statement->bindValue(':pass', $password);
		$statement->bindValue(':fname', $fname);
		$statement->bindValue(':lname', $lname);
		$statement->bindValue(':Email', $email);
        $statement->execute();

	}

}
