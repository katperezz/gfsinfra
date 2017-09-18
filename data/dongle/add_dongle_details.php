<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/dongle.php');

	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
		var $custodian;
		var $location;
		var $item_description;
		var $deployed_date;
		var $deployed_by;
		var $returned_date;
		var $returned_to;
	}

	$custodian = $_POST['custodian'];
	$location = $_POST['location'];
	$item_description = $_POST['item_description'];
	$deployed_date = $_POST['deployed_date'];
	$deployed_by = $_POST['deployed_by'];
	$returned_date = $_POST['returned_date'];
	$returned_to = $_POST['returned_to'];

	$res=$dongle->addDongle($custodian,$location,$item_description,$deployed_date,$deployed_by,$returned_date,$returned_to);
	
	$action='add';
	$type  ='dongle';	
	$item_id  ="DGL-";
    $logs=$listing->addLogs($action,$type,$item_id,$user); 


    $jsonresponse->success = true;
    $jsonresponse->message ="Record Added";
    // $jsonresponse->total = "0";
    // $jsonresponse->data = 'YEY';

    echo json_encode($jsonresponse);
    
?>