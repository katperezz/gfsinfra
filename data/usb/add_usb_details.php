<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/usb.php');

	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
		var $name;
		var $item_desc;
		var $date_deployed;
		var $deployed_by;
		var $date_returned;
		var $returned_to;
		var $warranty_date;
	}

	$name = $_POST['name'];
	$item_desc = $_POST['item_desc'];
	$date_deployed = $_POST['date_deployed'];
	$deployed_by = $_POST['deployed_by'];
	$date_returned = $_POST['date_returned'];
	$returned_to = $_POST['returned_to'];
	$warranty_date = $_POST['warranty_date'];

	$res=$usb->addUsb($name,$item_desc,$date_deployed,$deployed_by,$date_returned,$returned_to,$warranty_date);
	
	$action='add';
	$type  ='usb';	
	$item_id  ="USB-";
    $logs=$listing->addLogs($action,$type,$item_id,$user); 


    $jsonresponse->success = true;
    $jsonresponse->message ="Record Added";
    // $jsonresponse->total = "0";
    // $jsonresponse->data = 'YEY';

    echo json_encode($jsonresponse);
    
?>