<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');

    $jsonresponse = new stdClass();

    class field{     
        var $id;
        var $name;
        var $item_desc;
        var $date_deployed;
        var $deployed_by;
        var $date_returned;
        var $returned_to;
        var $warranty_date;
        var $status;
    }

    $qselect = "SELECT * from usb where status<>'deleted'";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

    foreach ($listing->loadAll($qselect) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->name= $row['name'];
        $field->item_desc= $row['item_desc'];
        $field->date_deployed= $row['date_deployed'];
        $field->deployed_by= $row['deployed_by'];
        $field->date_returned= $row['date_returned'];
        $field->returned_to= $row['returned_to'];
        $field->warranty_date= $row['warranty_date'];
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