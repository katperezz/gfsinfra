<?php

class Login{

			public $host="localhost";
			public $user="root";
			public $pass="";
			public $conn;
			
			public function OpenDB(){

				$this->conn = new PDO("mysql:host=".$this->host.";dbname=assets",$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
				
				if(!$this->conn){
					return false;
				}

				return true;
			
			}
			
			public function LoginAuth($email,$pass){

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

				$shapass = sha1($pass);

				
				$sql = "Select * from users where email = :email and pass = :pass";
				
				$q = $this->conn->prepare($sql);

				$value = array(':email'=>$email,':pass'=>$shapass);
				
				$q->execute($value);

				$count = $q->rowCount();
				

				if($count != 0){
						return true;					

				}else{
					return false;
					
				}


				return false;
			}

			public function GetId($email,$pass){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$shapass = sha1($pass);
				$sql = "Select * from users where email = :email and pass = :pass";
				
				$q = $this->conn->prepare($sql);

				$value = array(':email'=>$email,':pass'=>$shapass);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}

			public function GetData($id){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "Select * from users where id = :id";
				$q = $this->conn->prepare($sql);
				$value = array(':id'=>$id);
				$q->execute($value);

				while ($row = $q->fetch(PDO::FETCH_ASSOC)){     			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}

			public function loginLogs($action,$email){

				try{						
					if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}

				$sql = "INSERT INTO logs (action,user) VALUES (:action,:email)";

				$q = $this->conn->prepare($sql);

				$values =  array(':action'=>$action,':email'=>$email);

				if(!$q->execute($values)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er;	

					throw new Exception($emsg);
					return false;
				}

				return true;

				}catch(Exception $e){
					$err = "Message: ".$e->getMessage()."\n File: ".$e->getFile()." Line: " . $e->getLine()."\n Trace: ".$e->getTraceAsString(); 
					catcherror_log($err);
				}		

			}


		

}

$login = new Login();
// echo $login->LoginAuth('test@yahoo.com','test123')
// foreach($login->GetId('test@yahoo.com','test123') as $row){
// 	$id = $row['id'];
// }
// echo $id;

?>