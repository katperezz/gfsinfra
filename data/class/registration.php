<?php

class Register{

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



			public function CheckExist($email){

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

				$shapass = sha1($pass);		

				
				$sql = "Select * from users where email = :email";
				
				$q = $this->conn->prepare($sql);

				$value = array(':email'=>$email);
				
				$q->execute($value);

				$count = $q->rowCount();
				

				if($count != 0){ 
						return true;					

				}else{
					return false;
					
				}


				return false;
			}

			public function Registration($fname,$lname,$email,$pass,$utype){


					if(!$this->OpenDB()){
					
							error_log("OPEN DB ERROR!");
							return false;
					}

				$shapass = sha1($pass);		
				$sql  	 = "INSERT INTO users (fname,lname,email,pass,user_type) VALUES(:fname,:lname,:email,:pass, :utype)";
				
				$q = $this->conn->prepare($sql);
				$q_array = array(':fname'=>$fname,':lname'=>$lname,':email'=>$email,':pass'=>$pass,':utype'=>$utype);

				if(!$q->execute($q_array)){

					$errmsg = implode(" ", $q->errorInfo());
					$er = implode(" ", $this->conn->errorInfo());
					$emsg = "error code  :".$errmsg." || error code  : ".$er; 

					throw new Exception($emsg);

					return false;

				}

				return true;

			}
		

}

$register = new Register();


?>