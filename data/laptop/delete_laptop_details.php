<?php

    session_start();
    header("Content-type: application/json");
    include('../class/laptop.php');
    include('../class/listing_tbl.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 

    class field{         
        var $id;
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
    }

    $id = $_POST['id'];

    $res = $laptop->deleteLaptop($id);
    $action='delete';
    $type='laptop';
    $logs=$listing->deleteLogs($id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="Record deleted";

    echo json_encode($jsonresponse);
    
?>