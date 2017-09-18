<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/monitor.php');



	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
		var $custodian;
		var $location;
		var $asst_tag_no;
		var $serial_no;
		var $model;
		var $brand;
		var $specification;
		var $acquisition_date;
		var $warranty;
		var $remarks;
		var $date_created;
	}

	$custodian = $_POST['custodian'];
	$location = $_POST['location'];
	$asst_tag_no = $_POST['asst_tag_no'];
	$serial_no = $_POST['serial_no'];
	$model = $_POST['model'];
	$brand = $_POST['brand'];
	$specification = $_POST['specification'];
	$acquisition_date = $_POST['acquisition_date'];
	$warranty = $_POST['warranty'];
	$remarks = $_POST['remarks'];
	$date_created = date("Y-m-d H:i:s");

	echo $date_created;
	$res=$monitor->addMonit($custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$acquisition_date,$warranty,$remarks,$date_created);
	
	$action='add';
	$type  ='monitor';	
	$item_id  =$asst_tag_no;	
    $logs=$listing->addLogs($action,$type,$item_id,$user); 


    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = "0";
    $jsonresponse->data = 'YEY';

    echo json_encode($jsonresponse);
    
?>