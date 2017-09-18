<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');


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

    $id = $_GET['id'];


    $qselect = "SELECT * from logs where item_id='$id'";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;
    $q_array = null;

    foreach ($listing->loadAll($qselect) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->action= $row['action'];
        $field->type= $row['type'];
        $field->item_id= $row['item_id'];
        $field->field= $row['field'];
        $field->value_old= $row['value_old'];
        $field->value_new= $row['value_new'];
        $field->user= $row['user'];
        $field->timestamp= $row['timestamp'];

        $q_array[$i]=$field;
        $i++;
    }


    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = $total;
    $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>