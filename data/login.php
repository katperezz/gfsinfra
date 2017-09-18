<?php
header("Content-type: application/json");
include('class/login.php');

$jsonresponse = new stdClass();

$email = $_POST['email'];
$pass  = $_POST['password'];
// $email = 'test@yahoo.com';
// $pass  = 'test123';



	if($login->LoginAuth($email,$pass)){
		
		foreach($login->GetId($email,$pass) as $row){
			$id = $row['id'];
		}

		$_data = array();
		foreach($login->GetData($id) as $row){
		    $_data[] = array(
		        'fname' => $row['fname'],
		        'lname' => $row['lname'],
		        'email' => $row['email'],
		        'user_type' => $row['user_type']
		        // and so on for the rest
		    );
		}

		$action='login';
		$logs=$login->loginLogs($action,$email); 

		
		// echo $_data;
		// $i=0;
		// foreach($login->GetData($email,$pass) as $row){
		// 	$data = new stdObject();  
		// 		$data->fname =$row['fname'];
		// 		$data->lname =$row['lname'];
		// 		$data->email =$row['email'];

		// 	$q_array[$i]=$data;
		// }


		//display success message
		$jsonresponse->success   	 = true;
		$jsonresponse->msg 		 	 = "Welcome " +$email;
		$jsonresponse->data          = $_data;

		echo json_encode($jsonresponse);

	}else{

		//display failure message
		$jsonresponse->success   	 = false;
		$jsonresponse->msg 		 	 = "Please check email and password";
		$jsonresponse->data          = "";

		echo json_encode($jsonresponse);

	}



?>