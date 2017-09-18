<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/usb.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 

    class field{        
        var $name;
        var $item_desc;
        var $date_deployed;
        var $deployed_by;
        var $date_returned;
        var $returned_to;
        var $warranty_date;
        var $status;
    }

    $id = $_POST['id'];
    $item_id = "USB-".$id;

    $res = $usb->deleteUsb($id);
    $action='delete';
    $type='usb';
    $logs=$listing->deleteLogs($item_id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="Record deleted";
    $jsonresponse->data = $res;

    echo json_encode($jsonresponse);
    
?>