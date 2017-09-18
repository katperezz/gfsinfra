<?php

class Dongle{

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

		public function updateDongle($id,$custodian,$location,$item_description,$deployed_date,$deployed_by,$returned_date,$returned_to){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				$sql = "UPDATE dongle SET custodian =:custodian, location =:location, item_description =:item_description, deployed_date =:deployed_date, deployed_by =:deployed_by, returned_date =:returned_date, returned_to =:returned_to where  id = '".$id."'";

				$q = $this->conn->prepare($sql);

				$values =  array(':custodian'=>$custodian,':location'=>$location,':item_description'=>$item_description,':deployed_date'=>$deployed_date,':deployed_by'=>$deployed_by,':returned_date'=>$returned_date,':returned_to'=>$returned_to);
					
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


		public function CurrIdDongle($id){
				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}
			
			$sql = "Select * from dongle where id = :id";
			
			$q = $this->conn->prepare($sql);

			$value = array(':id'=>$id);
			
			$q->execute($value);


			while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
			 				
					$data[]=$row;
				}

				//array
			return $data;
		}

		public function deleteDongle($id){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				// $sql = "DELETE FROM monitor where  id = '".$id."'";

				$status = 'deleted';
				$sql = "UPDATE dongle SET status ='deleted' where  id = '".$id."'";

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


		public function addDongle($custodian,$location,$item_description,$deployed_date,$deployed_by,$returned_date,$returned_to){

			try{						
				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}
			$sql = "INSERT INTO dongle (custodian,location,item_description,deployed_date,deployed_by,returned_date,returned_to) VALUES (:custodian,:location,:item_description,:deployed_date,:deployed_by,:returned_date,:returned_to)";

			$q = $this->conn->prepare($sql);

			$values =  array(':custodian'=>$custodian,':location'=>$location,':item_description'=>$item_description,':deployed_date'=>$deployed_date,':deployed_by'=>$deployed_by,':returned_date'=>$returned_date,':returned_to'=>$returned_to);
				
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

$dongle = new Dongle();