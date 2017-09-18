<?php

class Laptop{

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


		public function CurrIdLaptop($id){
				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}
			
			$sql = "Select * from laptop where id = :id";
			
			$q = $this->conn->prepare($sql);

			$value = array(':id'=>$id);
			
			$q->execute($value);


			while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
			 				
					$data[]=$row;
				}

				//array
			return $data;
		}



			public function addLaptop($custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$mac_address_lan,$mac_address_wan,$specification,$OS,$OS_license,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}
				$sql = "INSERT INTO laptop (custodian,location,asst_tag_no,serial_no,model,brand,mac_address_lan,mac_address_wan,specification,OS,OS_license,acquisition_date,LTTPS,NBD,POW,proSupport_IT_tech,remarks) VALUES (:custodian,:location,:asst_tag_no,:serial_no,:model,:brand,:mac_address_lan,:mac_address_wan,:specification,:OS,:OS_license,:acquisition_date,:LTTPS,:NBD,:POW,:proSupport_IT_tech,:remarks)";

				$q = $this->conn->prepare($sql);

				$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':model'=>$model,':brand'=>$brand,':mac_address_lan'=>$mac_address_lan,':mac_address_wan'=>$mac_address_wan,':specification'=>$specification,':OS'=>$OS,':OS_license'=>$OS_license,':acquisition_date'=>$acquisition_date,':LTTPS'=>$LTTPS,':NBD'=>$NBD,':POW'=>$POW,':proSupport_IT_tech'=>$proSupport_IT_tech,':remarks'=>$remarks);
					
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



   

			public function updateLaptop($id,$custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$mac_address_lan,$mac_address_wan,$specification,$OS,$OS_license,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks){
					try{						
						if(!$this->OpenDB()){
							error_log("OPEN DB ERROR!");
							return false;
						}

					$sql = "UPDATE laptop SET custodian =:custodian,location =:location,asst_tag_no =:asst_tag_no,serial_no =:serial_no,model =:model,brand =:brand,mac_address_lan =:mac_address_lan,mac_address_wan =:mac_address_wan,specification =:specification,OS =:OS,OS_license =:OS_license,acquisition_date =:acquisition_date,LTTPS =:LTTPS,NBD =:NBD,POW =:POW,proSupport_IT_tech =:proSupport_IT_tech,remarks =:remarks					where  id = '".$id."'";

					$q = $this->conn->prepare($sql);

					$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':model'=>$model,':brand'=>$brand,':mac_address_lan'=>$mac_address_lan,':mac_address_wan'=>$mac_address_wan,':specification'=>$specification,':OS'=>$OS,':OS_license'=>$OS_license,':acquisition_date'=>$acquisition_date,':LTTPS'=>$LTTPS,':NBD'=>$NBD,':POW'=>$POW,':proSupport_IT_tech'=>$proSupport_IT_tech,':remarks'=>$remarks);
						
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

$laptop = new Laptop();