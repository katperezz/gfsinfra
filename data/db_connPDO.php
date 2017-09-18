<?php

class DbConnection {

	public $host="localhost";
	public $user="root";
	public $pass="";
	public $conn;

	public function query($sqlselect){

		$this->conn = new PDO("mysql:host=".$this->host.";dbname=assets",$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

	    // $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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

	}		

}

$conn = new DbConnection();


?>