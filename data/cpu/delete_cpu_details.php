<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/cpu.php');

    $jsonresponse = new stdClass();

    $user         = $_POST['user']; 

    class field{         
        var $custodian;
        var $location;
        var $asst_tag_no;
        var $serial_no;
        var $model;
        var $brand;
        var $specification;
        var $mac_addr_lan;
        var $mac_addr_wan;
        var $os;
        var $win10_os_license;
        var $win7_os_license;
        var $acquisition_date;
        var $LTTPS;
        var $NBD;
        var $POW;
        var $proSupport_IT_tech;
        var $remarks;
    }

    $id = $_POST['id'];
    echo $id;
    $res = $cpu->deleteCPU($id);
    $action='delete';
    $type='cpu';
    $logs=$listing->deleteLogs($id,$action,$type,$user); 

    $jsonresponse->success = true;
    $jsonresponse->message ="Record deleted";
    // $jsonresponse->total = '0';
    // $jsonresponse->data = $res;

    echo json_encode($jsonresponse);
    
?>