<?php

class CPU{

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

		public function updateCPU($id,$custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$mac_addr_lan,$mac_addr_wan,$os,$win10_os_license,$win7_os_license,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				$sql = "UPDATE cpu SET custodian = :custodian, location = :location, asst_tag_no = :asst_tag_no, serial_no = :serial_no, model = :model, brand = :brand, specification = :specification, mac_addr_lan = :mac_addr_lan, mac_addr_wan = :mac_addr_wan, os = :os, win10_os_license = :win10_os_license, win7_os_license = :win7_os_license, acquisition_date = :acquisition_date, LTTPS = :LTTPS, NBD = :NBD, POW = :POW, proSupport_IT_tech = :proSupport_IT_tech, remarks = :remarks where  id = '".$id."'";

				$q = $this->conn->prepare($sql);

				$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':model'=>$model,':brand'=>$brand,':specification'=>$specification,':mac_addr_lan'=>$mac_addr_lan,':mac_addr_wan'=>$mac_addr_wan,':os'=>$os,':win10_os_license'=>$win10_os_license,':win7_os_license'=>$win7_os_license,':acquisition_date'=>$acquisition_date,':LTTPS'=>$LTTPS,':NBD'=>$NBD,':POW'=>$POW,':proSupport_IT_tech'=>$proSupport_IT_tech,':remarks'=>$remarks);
					
				    if(!$q->execute($values)){

				    		$errmsg = implode(" ", $q->errorInfo());
				    		$er = implode(" ", $this->conn->errorInfo());
				    		$emsg = "error code  :".$errmsg." || error code  : ".$er;	
				    
				    		throw new Exception($emsg);
				    		echo $emsg;

				    		return false;
						}

				return true;

				}catch(Exception $e){
					$err = "Message: ".$e->getMessage()."\n File: ".$e->getFile()." Line: " . $e->getLine()."\n Trace: ".$e->getTraceAsString(); 
					catcherror_log($err);
				}	

		}


		public function CurrIdCPU($id){
				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}
			
			$sql = "Select * from cpu where id = :id";
			
			$q = $this->conn->prepare($sql);

			$value = array(':id'=>$id);
			
			$q->execute($value);


			while ($row = $q->fetch(PDO::FETCH_ASSOC)){ 
			 				
					$data[]=$row;
				}

				//array
			return $data;
		}

		public function deleteCPU($id){

				try{						
					if(!$this->OpenDB()){
						error_log("OPEN DB ERROR!");
						return false;
					}

				// $sql = "DELETE FROM monitor where  id = '".$id."'";

				$status = 'deleted';
				$sql = "UPDATE cpu SET status ='deleted' where  id = '".$id."'";

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


		public function addCPU($custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$mac_addr_lan,$mac_addr_wan,$os,$win10_os_license,$win7_os_license,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks){

			try{						
				if(!$this->OpenDB()){
					error_log("OPEN DB ERROR!");
					return false;
				}
			$sql = "INSERT INTO cpu (custodian,location,asst_tag_no,serial_no,model,brand,specification,mac_addr_lan,mac_addr_wan,os,win10_os_license,win7_os_license,acquisition_date,LTTPS,NBD,POW,proSupport_IT_tech,remarks) VALUES (:custodian,:location,:asst_tag_no,:serial_no,:model,:brand,:specification,:mac_addr_lan,:mac_addr_wan,:os,:win10_os_license,:win7_os_license,:acquisition_date,:LTTPS,:NBD,:POW,:proSupport_IT_tech,:remarks)";

			$q = $this->conn->prepare($sql);

			$values =  array(':custodian'=>$custodian,':location'=>$location,':asst_tag_no'=>$asst_tag_no,':serial_no'=>$serial_no,':model'=>$model,':brand'=>$brand,':specification'=>$specification,':mac_addr_lan'=>$mac_addr_lan,':mac_addr_wan'=>$mac_addr_wan,':os'=>$os,':win10_os_license'=>$win10_os_license,':win7_os_license'=>$win7_os_license,':acquisition_date'=>$acquisition_date,':LTTPS'=>$LTTPS,':NBD'=>$NBD,':POW'=>$POW,':proSupport_IT_tech'=>$proSupport_IT_tech,':remarks'=>$remarks);
				
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

$cpu = new CPU();

// $id = '1';
// $no = 1;

// foreach ($cpu->CurrIdCPU($id) as $row) {

//     echo $row['location'] . '<br />';
//     $no++;

// }
