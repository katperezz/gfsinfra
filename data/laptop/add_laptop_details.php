<?php

    session_start();
    header("Content-type: application/json");
    include('../class/laptop.php');
    include('../class/listing_tbl.php');



	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{            
        var $id;
        var $custodian;
        var $location;
        var $asst_tag_no;
        var $serial_no;
        var $model;
        var $brand;
        var $mac_address_lan;
        var $mac_address_wan;
        var $specification;
        var $OS;
        var $OS_license;
        var $acquisition_date;
        var $LTTPS;
        var $NBD;
        var $POW;
        var $proSupport_IT_tech;
        var $remarks;
	}
 	
	$custodian = $_POST['custodian'];
	$location = $_POST['location'];
	$asst_tag_no = $_POST['asst_tag_no'];
	$serial_no = $_POST['serial_no'];
	$model = $_POST['model'];
	$brand = $_POST['brand'];
	$mac_address_lan = $_POST['mac_address_lan'];
	$mac_address_wan = $_POST['mac_address_wan'];
	$specification = $_POST['specification'];
	$OS = $_POST['OS'];
	$OS_license = $_POST['OS_license'];
	$acquisition_date = $_POST['acquisition_date'];
	$LTTPS = $_POST['LTTPS'];
	$NBD = $_POST['NBD'];
	$POW = $_POST['POW'];
	$proSupport_IT_tech = $_POST['proSupport_IT_tech'];
	$remarks = $_POST['remarks'];

	$res=$laptop->addLaptop($custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$mac_address_lan,$mac_address_wan,$specification,$OS,$OS_license,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks);


    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = "0";
    $jsonresponse->data = 'YEY';

    echo json_encode($jsonresponse);
    
?>