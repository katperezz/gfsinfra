<?php

class Pocketwifi{

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

		public function updatePocketwifi($id,$custodian,$location,$asst_tag_no,$serial_no,$imei,$model,$brand,$isp,$specification,$acquisition_date,$warranty,$remarks){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				$sql = "UPDATE pocketwifi SET custodian =:custodian,location = :location, asst_tag_no = :asst_tag_no, serial_no = :serial_no, imei = :imei, model = :model, brand = :brand, isp = :isp, specification = :specification, acquisition_date = :acquisition_date, warranty = :warranty, remarks = :remarks where  id = '".$id."'";

				$q = $this->conn->prepare($sql);

				$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':imei'=>$imei,':model'=>$model,':brand'=>$brand,':isp'=>$isp,':specification'=>$specification,':acquisition_date'=>$acquisition_date,':acquisition_date'=>$acquisition_date,':warranty'=>$warranty,':remarks'=>$remarks);
					
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


		public function CurrIdPocketwifi($id){
				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}
			
			$sql = "Select * from pocketwifi where id = :id";
			
			$q = $this->conn->prepare($sql);

			$value = array(':id'=>$id);
			
			$q->execute($value);


			while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
			 				
					$data[]=$row;
				}

				//array
			return $data;
		}

		public function deletePocketwifi($id){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				// $sql = "DELETE FROM monitor where  id = '".$id."'";

				$status = 'deleted';
				$sql = "UPDATE pocketwifi SET status ='deleted' where  id = '".$id."'";

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


		public function addPocketwifi($custodian,$location,$asst_tag_no,$serial_no,$imei,$model,$brand,$isp,$specification,$acquisition_date,$warranty,$remarks){

			try{						
				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}
			$sql = "INSERT INTO pocketwifi (custodian,location,asst_tag_no,serial_no,imei,model,brand,isp,specification,acquisition_date,warranty,remarks) VALUES (:custodian,:location,:asst_tag_no,:serial_no,:imei,:model,:brand,:isp,:specification,:acquisition_date,:warranty,:remarks)";

			$q = $this->conn->prepare($sql);

			$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':imei'=>$imei,':model'=>$model,':brand'=>$brand,':isp'=>$isp,':specification'=>$specification,':acquisition_date'=>$acquisition_date,':warranty'=>$warranty,':remarks'=>$remarks);
				
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

$pocketwifi = new Pocketwifi();