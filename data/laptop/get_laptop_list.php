<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');


    $jsonresponse = new stdClass();


    class field{         
        var $id;
        var $custodian;
        var $location;
        var $asst_tag_no;
        var $serial_no;
        var $model;
        var $brand;
        var $mac_address_lan;
        var $mac_address_wan;
        var $specification;
        var $OS;
        var $OS_license;
        var $acquisition_date;
        var $LTTPS;
        var $NBD;
        var $POW;
        var $proSupport_IT_tech;
        var $remarks;
    }

    $qselect = "SELECT * from laptop";
    $total = $listing->NumRow($qselect);
    // $total = $listing->Listing('bapt_tbl');

    $i=0;

    foreach ($listing->loadAll($qselect) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->custodian= $row['custodian'];
        $field->location= $row['location'];
        $field->asst_tag_no= $row['asst_tag_no'];
        $field->serial_no= $row['serial_no'];
        $field->model= $row['model'];
        $field->brand= $row['brand'];
        $field->mac_address_lan= $row['mac_address_lan'];
        $field->mac_address_wan= $row['mac_address_wan'];
        $field->specification= $row['specification'];
        $field->OS= $row['OS'];
        $field->OS_license= $row['OS_license'];
        $field->acquisition_date= $row['acquisition_date'];
        $field->LTTPS= $row['LTTPS'];
        $field->NBD= $row['NBD'];
        $field->POW= $row['POW'];
        $field->proSupport_IT_tech= $row['proSupport_IT_tech'];
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