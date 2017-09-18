<?php

    session_start();
    header("Content-type: application/json");
    include('../class/mobile.php');
    include('../class/listing_tbl.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 

    class field{         
        var $id;
    }

    $id = $_POST['id'];

    $res = $laptop->deleteLaptop($id);
    $action='delete';
    $type='mobile';
    $logs=$listing->deleteLogs($id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="Record deleted";

    echo json_encode($jsonresponse);
    
?>