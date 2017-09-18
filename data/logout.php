<?php 
header("Content-type: application/json");
include('class/login.php');

session_start();

if(isset($_POST['logout'])){
$email = $_POST['email'];

	$action='logout';
	$logs=$login->loginLogs($action,$email); 

	session_destroy();

	$msg = array('success' => true, 'message' => "logout"); 
	echo json_encode($msg);

}



?>