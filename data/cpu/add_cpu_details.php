<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/cpu.php');



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
		var $mac_addr_lan;
		var $mac_addr_wan;
		var $os;
		var $win10_os_license;
		var $win7_os_license;
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
	$specification = $_POST['specification'];
	$mac_addr_lan = $_POST['mac_addr_lan'];
	$mac_addr_wan = $_POST['mac_addr_wan'];
	$os = $_POST['os'];
	$win10_os_license = $_POST['win10_os_license'];
	$win7_os_license = $_POST['win7_os_license'];
	$acquisition_date = $_POST['acquisition_date'];
	$LTTPS = $_POST['LTTPS'];
	$NBD = $_POST['NBD'];
	$POW = $_POST['POW'];
	$proSupport_IT_tech = $_POST['proSupport_IT_tech'];
	$remarks = $_POST['remarks'];

	$res=$cpu->addCPU($custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$mac_addr_lan,$mac_addr_wan,$os,$win10_os_license,$win7_os_license,$acquisition_date,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks);
	
	$action='add';
	$type  ='cpu';	
	$item_id  =$asst_tag_no;	
    $logs=$listing->addLogs($action,$type,$item_id,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="Record added";
    // $jsonresponse->total = "0";
    // $jsonresponse->data = $user;

    echo json_encode($jsonresponse);
    
?>