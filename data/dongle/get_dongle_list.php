<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');

    $jsonresponse = new stdClass();

    class field{     
        var $id;
        var $custodian;
        var $location;
        var $item_description;
        var $deployed_date;
        var $deployed_by;
        var $returned_date;
        var $returned_to;
    }

    $qselect = "SELECT * from dongle where status<>'deleted'";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

    foreach ($listing->loadAll($qselect) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->custodian= $row['custodian'];
        $field->location= $row['location'];
        $field->item_description= $row['item_description'];
        $field->deployed_date= $row['deployed_date'];
        $field->deployed_by= $row['deployed_by'];
        $field->returned_date= $row['returned_date'];
        $field->returned_to= $row['returned_to'];

        $q_array[$i]=$field;
        $i++;
    }


    $jsonresponse->success = true;
    $jsonresponse->message ="Record loaded";
    $jsonresponse->total = $total;
    $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>