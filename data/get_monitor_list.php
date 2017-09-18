<?php

    session_start();
    header("Content-type: application/json");
    include('class/listing_tbl.php');


    $jsonresponse = new stdClass();


    class field{         
        var $employee_name;
        var $position;
        var $department;
        var $asset_status;
        var $asset;
        var $asset_tag_num;
        var $asset_brand;
        var $asset_serial;
        var $asset_model;
        var $received_by;
        var $released_by;
        var $date_released;
    }

    $qselect = "SELECT * from gfs";
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

    foreach ($listing->loadAll($qselect) as $row) {
        
    $field = new field();  

        $field->employee_name= $row['employee_name'];
        $field->position= $row['position'];
        $field->department= $row['department'];
        $field->asset_status= $row['asset_status'];
        $field->asset= $row['asset'];
        $field->asset_tag_num= $row['asset_tag_num'];
        $field->asset_brand= $row['asset_brand'];
        $field->asset_serial= $row['asset_serial'];
        $field->asset_model= $row['asset_model'];
        // $field->received_by= $row['received_by'];
        $field->released_by= $row['released_by'];
        $field->date_released= $row['date_released'];

        $q_array[$i]=$field;
        $i++;
    }


    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = "0";
    $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>