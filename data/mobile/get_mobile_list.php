<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');


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

    $qselect = "SELECT * from mobile where status<>'deleted'";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

    foreach ($listing->loadAll($qselect) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->location= $row['location'];
        $field->custodian= $row['custodian'];
        $field->asst_tag_no= $row['asst_tag_no'];
        $field->serial_no= $row['serial_no'];
        $field->imei= $row['imei'];
        $field->model= $row['model'];
        $field->brand= $row['brand'];
        $field->mac_address= $row['mac_address'];
        $field->specification= $row['specification'];
        $field->acquisition_date= $row['acquisition_date'];
        $field->warranty= $row['warranty'];
        $field->remarks= $row['remarks'];

        $q_array[$i]=$field;
        $i++;
    }


    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = $total;
    $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>