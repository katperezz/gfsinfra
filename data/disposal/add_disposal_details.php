<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');

	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
        var $disposal_name;
        var $brand;
        var $quantity;
        var $remarks;
	}

	$disposal_name = $_POST['disposal_name'];
	$brand = $_POST['brand'];
	$quantity = $_POST['quantity'];
	$remarks = $_POST['remarks'];

	$res=$listing->addDisposal($disposal_name,$brand,$quantity,$remarks);


    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = "0";
    $jsonresponse->data = 'YEY';

    echo json_encode($jsonresponse);
    
?>