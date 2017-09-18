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

    $qselect = "SELECT * from cpu where status<>'deleted'";
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
        $field->specification= $row['specification'];
        $field->mac_addr_lan= $row['mac_addr_lan'];
        $field->mac_addr_wan= $row['mac_addr_wan'];
        $field->os= $row['os'];
        $field->win10_os_license= $row['win10_os_license'];
        $field->win7_os_license= $row['win7_os_license'];
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
    $jsonresponse->message ="Record loaded";
    $jsonresponse->total = $total;
    $jsonresponse->data = $q_array;

    echo json_encode($jsonresponse);
    
?>