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
	public $subjects;
	public $description;
	public $id;
	public $phone;
	public $birthday;

    public function __construct() {
        
    }
     public function report(){
        $db = db_connect();
        $statement = $db->prepare(""
                . " select * from users join (select Username, count(*) as count from reminders group by Username) as r on Username = :username join personaldetails p on Username = :username join log l on Username = :username;");
        $statement->bindValue(':username',      $username);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function getReport($mostReminder = null, $from = null, $to = null, $totalLogin = null) {
        $db = db_connect();
        $query = "SELECT * FROM reminders inner join log l on Username = :username where deleted = 0";

        if ($from != null) {
            $query .= " and createdDate >= '" . $from . "'";
        }

        if ($to != null) {
            $query .= " and createdDate <= '" . $to . "'";
        }

        if ($mostReminder != null) {
            $query .= " and Attempt = (select max(Attempt) from log)";
        }
        
        if($totalLogin != null){
            $query .= " and Attempt = " . $totalLogin;
        }
        
        $statement->bindValue(':username',      $username);
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

	public function get_reminders () {
		$db = db_connect();
        $statement = $db->prepare("SELECT * FROM reminders
                                WHERE username = :username AND deleted = 0;");
        $statement->bindValue(':username', $_SESSION['username']);
		
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}
	
	public function update ($id,$subjects,$description) {
		$db = db_connect();
        $statement = $db->prepare("UPDATE reminders SET subjects = :subjects, Description = :description WHERE
                                id = :id;");
        $statement->bindValue(':id', 			$id);
		$statement->bindValue(':subjects',      $subjects);
        $statement->bindValue(':description',   $description);
        $statement->execute();
	}
	
	public function removeItem($id) {
		$db = db_connect();
        $statement = $db->prepare("UPDATE reminders SET deleted = 1 WHERE id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();
	}
	public function addToTable($username,$subjects,$description){
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO reminders (Username, subjects,Description)"
                . "VALUES (:username, :subjects, :description);");
        $statement->bindValue(':username',      $username);
        $statement->bindValue(':subjects',      $subjects);
        $statement->bindValue(':description',   $description);
        $statement->execute();

    }

    public function addProfile($username) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO profile (Username, Birthday, PhoneNumber, FirstName, LastName, Email)"
                . " VALUES (:username,:birthday, :phoneNumber, :firstName, :lastName, :email);");
        $statement->bindValue(':username',      $username);
        $statement->bindValue(':birthday',		null);
        $statement->bindValue(':phoneNumber', 	'');
        $statement->bindValue(':firstName', 	'');
        $statement->bindValue(':lastName',		'');
        $statement->bindValue(':email',			'');
        $statement->execute();
    }

     public function getUser() {
        $db = db_connect();
        $statement = $db->prepare("select * from profile where Username = :username ");
        $statement->bindValue("username", $this->username);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if($rows){
        	$_SESSION['birthday']  = $rows[0]['Birthday'];
            $_SESSION['phone']  = $rows[0]['PhoneNumber'];
            $_SESSION['firstname']  = $rows[0]['FirstName'];
            $_SESSION['lastname']  = $rows[0]['LastName'];
            $_SESSION['email']  = $rows[0]['Email'];
        }
        return $rows;
    }
    public function updateProfile() {
        $db = db_connect();
        $statement = $db->prepare("update Profile set Username = :username,Birthday = :birthday, PhoneNumber = :phoneNumber,FirstName = :firstName,  LastName = :lastName,  Email = :email where Username = :username;");

      	$statement->bindValue(':username',      $this->username);
        $statement->bindValue(':birthday',		$this->birthday);
        $statement->bindValue(':phoneNumber', 	$this->phone);
        $statement->bindValue(':firstName', 	$this->fname);
        $statement->bindValue(':lastName',		$this->lname);
        $statement->bindValue(':email',			$this->email);
        $statement->execute();
    }

    public function authenticate() {
 
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
		
		if(strlen($password) < 8){
			
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
