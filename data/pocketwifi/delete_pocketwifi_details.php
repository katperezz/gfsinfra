<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/pocketwifi.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 

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

    $id = $_POST['id'];

    $res = $pocketwifi->deletePocketwifi($id);
    $action='delete';
    $type='pocketwifi';
    $logs=$listing->deleteLogs($id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="Record deleted";
    $jsonresponse->total = '0';
    $jsonresponse->data = $res;

    echo json_encode($jsonresponse);
    
?>