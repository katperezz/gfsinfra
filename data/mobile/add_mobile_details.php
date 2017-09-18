<?php

    session_start();
    header("Content-type: application/json");
    include('../class/mobile.php');
    include('../class/listing_tbl.php');



	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{            
        var $id;
        var $location;
        var $custodian;
        var $asst_tag_no;
        var $serial_no;
        var $imei;
        var $model;
        var $brand;
        var $mac_address;
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
    $mac_address = $_POST['mac_address'];
    $specification = $_POST['specification'];
    $acquisition_date = $_POST['acquisition_date'];
    $remarks = $_POST['remarks'];
        
	$res=$mobile->addMobile($location,$custodian,$asst_tag_no,$serial_no,$imei,$model,$brand,$mac_address,$specification,$acquisition_date,$warranty,$remarks);


    $jsonresponse->success = true;
    $jsonresponse->message ="Record successfully added";

    echo json_encode($jsonresponse);
    
?>