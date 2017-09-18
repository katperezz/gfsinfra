<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');


    $jsonresponse = new stdClass();


    class field{         
        var $id;
        var $action;
        var $type;
        var $item_id;
        var $field;
        var $value_old;
        var $value_new;
        var $user;
        var $timestamp;
    }

    $id = $_GET['id'];


    $qselect = "SELECT * from logs where item_id=$id";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

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
    $jsonresponse->message ="Record logs loaded";
    $jsonresponse->total = $total;
    $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>