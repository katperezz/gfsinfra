<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/dongle.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 

    class field{        
        var $custodian;
        var $location;
        var $item_description;
        var $deployed_date;
        var $deployed_by;
        var $returned_date;
        var $returned_to;        
    }

    $id = $_POST['id'];
    $item_id = "DGL-".$id;

    $res = $dongle->deleteDongle($id);
    $action='delete';
    $type='dongle';
    $logs=$listing->deleteLogs($item_id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="Record deleted";
    $jsonresponse->data = $res;

    echo json_encode($jsonresponse);
    
?>