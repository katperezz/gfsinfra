<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/pocketwifi.php');



	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
		var $custodian;
		var $location;
		var $asst_tag_no;
		var $serial_no;
		var $imei;
		var $model;
		var $brand;
		var $isp;
		var $specification;
		var $acquisition_date;
		var $warranty;
		var $remarks;
	}

	$custodian = $_POST['custodian'];
	$location = $_POST['location'];
	$asst_tag_no = $_POST['asst_tag_no'];
	$serial_no = $_POST['serial_no'];
	$imei = $_POST['imei'];
	$model = $_POST['model'];
	$brand = $_POST['brand'];
	$isp = $_POST['isp'];
	$specification = $_POST['specification'];
	$acquisition_date = $_POST['acquisition_date'];
	$warranty = $_POST['warranty'];
	$remarks = $_POST['remarks'];

	$res=$pocketwifi->addPocketwifi($custodian,$location,$asst_tag_no,$serial_no,$imei,$model,$brand,$isp,$specification,$acquisition_date,$warranty,$remarks);
	
	$action='add';
	$type  ='pocketwifi';	
	$item_id  =$asst_tag_no;	
    $logs=$listing->addLogs($action,$type,$item_id,$user); 


    $jsonresponse->success = true;
    $jsonresponse->message ="Record added";
    // $jsonresponse->total = "0";
    // $jsonresponse->data = 'YEY';

    echo json_encode($jsonresponse);
    
?>