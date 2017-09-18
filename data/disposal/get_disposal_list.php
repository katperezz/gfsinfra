<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');

    $jsonresponse = new stdClass();

    class field{         
        var $id;
        var $disposal_name;
        var $brand;
        var $quantity;
        var $remarks;
    }

    $qselect = "SELECT * from disposal";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

    foreach ($listing->loadAll($qselect) as $row) {
        
        $field = new field();  
  
        $field->id= $row['id'];
        $field->disposal_name= $row['disposal_name'];
        $field->brand= $row['brand'];
        $field->quantity= $row['quantity'];
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