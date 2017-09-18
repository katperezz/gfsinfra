<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/peripherals.php');



	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
		var $location;
		var $asst_tag_no;
		var $serial_no;
		var $model;
		var $brand;
		var $specification;
		var $acquisition_date;
		var $warranty_status;
		var $remarks;
	}

	$location = $_POST['location'];
	$asst_tag_no = $_POST['asst_tag_no'];
	$serial_no = $_POST['serial_no'];
	$model = $_POST['model'];
	$brand = $_POST['brand'];
	$specification = $_POST['specification'];
	$acquisition_date = $_POST['acquisition_date'];
	$warranty_status = $_POST['warranty_status'];
	$remarks = $_POST['remarks'];

	$res=$peripherals->addPericon($location,$asst_tag_no,$serial_no,$model,$brand,$specification,$acquisition_date,$warranty_status,$remarks);
	
	$action='add';
	$type  ='periphirals';	
	$item_id  =$asst_tag_no;	
    $logs=$listing->addLogs($action,$type,$item_id,$user); 


    $jsonresponse->success = true;
    $jsonresponse->message ="Record Added";
    // $jsonresponse->total = "0";
    // $jsonresponse->data = 'YEY';

    echo json_encode($jsonresponse);
    
?>