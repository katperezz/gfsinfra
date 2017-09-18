<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/ups.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 

    class field{         
        var $id;
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

    $res = $ups->deleteUPS($id);
    $action='delete';
    $type='ups';
    $logs=$listing->deleteLogs($id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = '0';
    $jsonresponse->data = $res;

    echo json_encode($jsonresponse);
    
?>