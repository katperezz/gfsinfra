<?php

class Listing{

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

			public function GetId($username,$password){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "Select * from users where username = :username and password = :password";
				
				$q = $this->conn->prepare($sql);

				$value = array(':username'=>$username,':password'=>$password);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}

			public function listall(){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}


				$sql = 'Select * from bapt_tbl';
				$rows = $this->conn->query($sql);

				return $rows;
			}

			public function loadAll($sqlselect)
		    {
					try{

						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

					    $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
					    $qselect = $this->conn->prepare($sqlselect);
					    
					    
					    if(!$qselect->execute()){

					            $errmsg = implode(" ", $qselect->errorInfo());
					            $er = implode(" ", $this->conn->errorInfo());
					            $emsg = "error code  :".$errmsg." || error code  : ".$er;	

					            throw new Exception($emsg);
					            return false;

					    }
			            $data = $qselect->fetchAll();
			            return $data;
					    

					}catch(Exception $e){
						$err = "\n Message: ".$e->getMessage()."\n File: ".$e->getFile()." Line: " . $e->getLine()."\n Trace: ".$e->getTraceAsString(); 
						// catcherror_log($err);
						return $err;

					}

			        // $sql = 'SELECT * FROM bapt_tbl';
			        // $rows = $this->conn->query($sql);

			        // return $rows;
		    }

			public function NumRow($sqlselect){
				
				try{

				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}


				$nrow = $this->conn->prepare($sqlselect);
				$nrow ->execute();



				     if(!$nrow->execute()){

				        $errmsg = implode(" ", $nrow->errorInfo());
				        $er = implode(" ", $this->conn->errorInfo());
				        $emsg = "error code  :".$errmsg." || error code  : ".$er;	

				        
				        throw new Exception($emsg);

				        return false;

					}

				$num_rows = $nrow->rowCount();

				return $num_rows;

				}catch(Exception $e){
					$err = "Message: ".$e->getMessage()."\n File: ".$e->getFile()." Line: " . $e->getLine()."\n Trace: ".$e->getTraceAsString(); 
					catcherror_log($err);
				}
			}


		
			public function updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				$sql = "INSERT INTO logs (action,type,item_id,field,value_old,value_new,user) VALUES (:action,:type,:item_id,:field,:value_old,:value_new,:user)";

				$q = $this->conn->prepare($sql);

				$values =  array(':action'=>$action,':type'=>$type,':item_id'=>$item_id,':field'=>$field,':value_old'=>$value_old,':value_new'=>$value_new,':user'=>$user);
					
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


			public function deleteLogs($id,$action,$type,$user){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				$sql = "INSERT INTO logs (item_id,action,type,user) VALUES (:id,:action,:type,:user)";

				$q = $this->conn->prepare($sql);

				$values =  array(':id'=>$id,':action'=>$action,':type'=>$type,':user'=>$user);
					
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

			public function addLogs($action,$type,$item_id,$user){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				$sql = "INSERT INTO logs (item_id,action,type,user) VALUES (:item_id,:action,:type,:user)";

				$q = $this->conn->prepare($sql);

				$values =  array(':item_id'=>$item_id,':action'=>$action,':type'=>$type,':user'=>$user);
					
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

			public function CurrIdDisposal($id){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "Select * from disposal where id = :id";
				
				$q = $this->conn->prepare($sql);

				$value = array(':id'=>$id);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}

			public function addDisposal($disposal_name,$brand,$quantity,$remarks){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				$sql = "INSERT INTO disposal (disposal_name,brand,quantity,remarks) VALUES (:disposal_name,:brand,:quantity,:remarks)";

				$q = $this->conn->prepare($sql);

				$values =  array(':disposal_name'=>$disposal_name,':brand'=>$brand,':quantity'=>$quantity,':remarks'=>$remarks);
					
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


			public function deleteDisposal($id){

					try{						
						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

					$sql = "DELETE FROM disposal where  id = '".$id."'";

					$q = $this->conn->prepare($sql);

					$values =  array(':id'=>$id);
						
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



			public function updateDisposal($id,$disposal_name,$brand,$quantity,$remarks){

					try{						
						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

					$sql = "UPDATE disposal SET disposal_name =:disposal_name,brand = :brand, quantity = :quantity, remarks = :remarks where  id = '".$id."'";

					$q = $this->conn->prepare($sql);

					$values =  array(':disposal_name'=>$disposal_name,':brand'=>$brand,':quantity'=>$quantity,':remarks'=>$remarks);
						
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

			public function deleteLaptop($id){

					try{						
						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

					$sql = "DELETE FROM monitor where  id = '".$id."'";

					$q = $this->conn->prepare($sql);

					$values =  array(':id'=>$id);
						
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

$listing = new Listing();
// $id = 'UPS-001';
// $qselect = "SELECT * from logs where item_id='$id'";
// $users    = $listing->loadAll($qselect);
// $no = 1;
// foreach ($users as $key => $value) {
//     echo $no . '. ' . $key . ' => ' . $value['action'] . '<br />';
//     $no++;
// }
// foreach($login->GetId('test@yahoo.com','test123') as $row){
// 	$id = $row['id'];
// }
// echo $id;

?>