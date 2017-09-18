<?php
header("Content-type: application/json");
include('class/registration.php');

$jsonresponse = new stdClass();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass1  = $_POST['password'];
$utype  = $_POST['utype'];

	// checking empty fields
	if(empty($fname) || empty($lname) || empty($email) || empty($pass1)) {

		//display failure message
		$jsonresponse->success   	 = false;
		$jsonresponse->msg 		 	 = "Please check fields";
		$jsonresponse->data          = "";

		echo json_encode($jsonresponse);

	}else{

		$pass=sha1($pass1);
		//insert data to database	
		 $register->Registration($fname,$lname,$email,$pass,$utype);
		// $result = mysqli_query($mysqli, "INSERT INTO users (fname,lname,email,pass) VALUES('$fname','$lname','$email','$pass')");
		
		//display success message
		$jsonresponse->success   	 = true;
		$jsonresponse->msg 		 	 = "User successfully added";
		$jsonresponse->data          = "";

		echo json_encode($jsonresponse);

	}


?>