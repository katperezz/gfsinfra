<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');

    $jsonresponse = new stdClass();

    class field{         
        var $id;
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
        var $status;
    }

    $qselect = "SELECT * from pocketwifi where status<>'deleted'";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

    foreach ($listing->loadAll($qselect) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->custodian= $row['custodian'];
        $field->location= $row['location'];
        $field->asst_tag_no= $row['asst_tag_no'];
        $field->serial_no= $row['serial_no'];
        $field->imei= $row['imei'];
        $field->model= $row['model'];
        $field->brand= $row['brand'];
        $field->isp= $row['isp'];
        $field->specification= $row['specification'];
        $field->acquisition_date= $row['acquisition_date'];
        $field->warranty= $row['warranty'];
        $field->remarks= $row['remarks'];
        $field->status= $row['status'];

        $q_array[$i]=$field;
        $i++;
    }


    $jsonresponse->success = true;
    $jsonresponse->message ="Record loaded";
    $jsonresponse->total = $total;
    $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>