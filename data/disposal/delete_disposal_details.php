<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 
    
    class field{         
        var $id;
    }

    $id = $_POST['id'];

    $res    = $listing->deleteDisposal($id);
    $action ='delete';
    $type   ='disposal';
    $logs   =$listing->deleteLogs($id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    $jsonresponse->total = '0';
    $jsonresponse->data = $res;

    echo json_encode($jsonresponse);
    
?>