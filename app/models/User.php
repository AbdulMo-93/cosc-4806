<?php

class User {

    public $username;
    public $password;
    public $auth = false;
	public $fname;
	public $lname;
	public $email;
	public $att;
	public $timein;

    public function __construct() {
        
    }

    public function authenticate() {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		$db = db_connect();
        $statement = $db->prepare("select Username, Password from users
                                WHERE Username = :name;");
        $statement->bindValue(':name', $this->username);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		$hash_pwd = $rows[0]['Password'];
		$password = $this->password;
		
		if (!password_verify($password,$hash_pwd)){
			$att = 1;
			$statement = $db->prepare("select * from logfail
                                WHERE Username = :name;");
       	 	$statement->bindValue(':name', $this->username);
        	$statement->execute();
        	$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			$att_num_data = $rows[0]['Attempts'];

        	if($att_num_data >=3){
				sleep(60);
				$statement = $db->prepare("UPDATE logfail SET Attempts = :att WHERE Username = :user");
		        $statement->bindValue(':user', $this->username);
		        $statement->bindValue(':att', 0);
		        $statement->execute();
				$this->auth = false;
        			
        	}else if($rows){	
        		$att = $att_num_data + 1;
		        $statement = $db->prepare("UPDATE logfail SET Attempts = :att WHERE Username = :user");
		        $statement->bindValue(':user', $this->username);
		        $statement->bindValue(':att', $att);
		        $statement->execute();

        	}else{
        	
				$statement1 = $db->prepare("INSERT INTO logfail (Username, Attempts)"
				. "VALUES (:username, :attempts); ");
				$statement1->bindValue(':username', $this->username);
				$statement1->bindValue(':attempts',	$att);
				$statement1->execute();
			}
		$this->auth = false;
	
		}else{
			$this->auth = true;
			$_SESSION['username'] = $rows[0]['Username'];
			$_SESSION['password'] = $rows[0]['Password'];
		}
		
    }
	
	public function register ($username, $password, $fname, $lname, $email) {
		
		if(strlen($password) >= 8){
			
			$hashPass = password_hash($password, PASSWORD_DEFAULT);
			
			$db = db_connect();
			$statement = $db->prepare("INSERT INTO users (Username, Password, FirstName, LastName, Email)"
			. "VALUES (:username, :password, :firstName, :lastName, :email ); ");
				
			$statement->bindValue(':username',	$username);
			$statement->bindValue(':password',	$hashPass);
			$statement->bindValue(':firstName',	$fname);
			$statement->bindValue(':lastName',	$lname);
			$statement->bindValue(':email', 	$email);
			$statement->execute();
			
			$_SESSION['auth'] = true;
		}
		else{
			header('Location: /login/register');
		}
	}

}
