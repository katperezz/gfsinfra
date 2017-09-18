<?php

class ListingLaptop{

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
			
			// public function listall($code){

			// 			if(!$this->OpenDB()){
			// 				error_log("OPEN DB ERROR!");
			// 				return false;
			// 			}

			// 	// $shapass = sha1($pass);		

				
			// 	$sql = "Select * from "+$code;
			// 	$q = $this->conn->prepare($sql);
			// 	$q->execute();

			// 	$count = $q->rowCount();
				

			// 	if($count != 0){
			// 			return true;					

			// 	}else{
			// 		return false;
					
			// 	}


			// 	return false;
			// }

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


			public function updateLaptop($id,$custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$acquisition_date,$warranty,$remarks){

					try{						
						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

					$sql = "UPDATE monitor SET custodian =:custodian,location = :location, asst_tag_no = :asst_tag_no, serial_no = :serial_no, model = :model, brand = :brand, specification = :specification, acquisition_date = :acquisition_date, warranty = :warranty, remarks = :remarks where  id = '".$id."'";

					$q = $this->conn->prepare($sql);

					$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':model'=>$model,':brand'=>$brand,':specification'=>$specification,':acquisition_date'=>$acquisition_date,':acquisition_date'=>$acquisition_date,':warranty'=>$warranty,':remarks'=>$remarks);
						
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


			public function CurrId($id){
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				
				$sql = "Select * from monitor where id = :id";
				
				$q = $this->conn->prepare($sql);

				$value = array(':id'=>$id);
				
				$q->execute($value);


				while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
    			 				
						$data[]=$row;
	 			}

	 			//array
				return $data;
			}
		
			public function updateLaptoplogs($item_id,$action,$type,$field,$value_old,$value_new,$user){

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

			public function deleteLaptoplogs($id,$action,$type,$user){

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


			public function addLaptop($custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$acquisition_date,$warranty,$remarks){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				$sql = "INSERT INTO monitor (custodian,location,asst_tag_no,serial_no,model,brand,specification,acquisition_date,warranty,remarks) VALUES (:custodian,:location,:asst_tag_no,:serial_no,:model,:brand,:specification,:acquisition_date,:warranty,:remarks)";

				$q = $this->conn->prepare($sql);

				$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':model'=>$model,':brand'=>$brand,':specification'=>$specification,':acquisition_date'=>$acquisition_date,':warranty'=>$warranty,':remarks'=>$remarks);
					
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

// $qselect = "SELECT * from gfs";
// $users    = $listing->loadAll($qselect);
// $no = 1;
// foreach ($users as $key => $value) {
//     echo $no . '. ' . $key . ' => ' . $value['position'] . '<br />';
//     $no++;
// }
// foreach($login->GetId('test@yahoo.com','test123') as $row){
// 	$id = $row['id'];
// }
// echo $id;

?>