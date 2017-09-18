<?php

    session_start();
    header("Content-type: application/json");
    include('class/listing_tbl.php');


    $jsonresponse = new stdClass();


    class field{         
        var $id;
    }

    $qselect = "SELECT * from monitor";
    $qselect1 = "SELECT * from cpu";
    $qselect2 = "SELECT * from ups";
    $qselect3 = "SELECT * from laptop";
    $qselect4 = "SELECT * from mobile";

    $monitor  = $listing->NumRow($qselect);
    $cpu = $listing->NumRow($qselect1);
    $ups = $listing->NumRow($qselect2);
    $laptop = $listing->NumRow($qselect3);
    $mobile = $listing->NumRow($qselect4);


    $jsonresponse->success = true;
    $jsonresponse->message ="YEY";
    // $jsonresponse->total = $total;
    $jsonresponse->monitor = $monitor;
    $jsonresponse->cpu = $cpu;
    $jsonresponse->ups = $ups;
    $jsonresponse->laptop = $laptop;
    $jsonresponse->mobile = $mobile;
    // $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>