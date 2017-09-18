<?php

    session_start();
    header("Content-type: application/json");
    include('../class/mobile.php');
    include('../class/listing_tbl.php');


	$rec  		  = json_decode($_POST['record'], true);	
	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

    class field{            
        var $id;
        var $location;
        var $custodian;
        var $asst_tag_no;
        var $serial_no;
        var $imei;
        var $model;
        var $brand;
        var $mac_address;
        var $specification;
        var $acquisition_date;
        var $warranty;
        var $remarks;
    }

    $id = $rec['id'];
    $custodian = $rec['custodian'];
    $location = $rec['location'];
    $asst_tag_no = $rec['asst_tag_no'];
    $serial_no = $rec['serial_no'];
    $imei = $rec['imei'];
    $model = $rec['model'];
    $brand = $rec['brand'];
    $mac_address = $rec['mac_address'];
    $specification = $rec['specification'];
    $acquisition_date = $rec['acquisition_date'];
    $warranty = $rec['warranty'];
    $remarks = $rec['remarks'];
        

    foreach ($mobile->CurrIdMobile($id) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->custodian= $row['custodian'];
        $field->location= $row['location'];
        $field->asst_tag_no= $row['asst_tag_no'];
        $field->serial_no= $row['serial_no'];
        $field->imei= $row['imei'];
        $field->model= $row['model'];
        $field->brand= $row['brand'];
        $field->mac_address= $row['mac_address'];
        $field->specification= $row['specification'];
        $field->acquisition_date= $row['warranty'];
        $field->warranty= $row['acquisition_date'];
        $field->remarks= $row['remarks'];

    $curr_item=$field;
    }

    $action = 'update';
    $type = 'mobile';
	$res=$mobile->updateMobile($id,$location,$custodian,$asst_tag_no,$serial_no,$imei,$model,$brand,$mac_address,$specification,$acquisition_date,$warranty,$remarks);

    $location_old =$field->location;
    $custodian_old =$field->custodian;
    $asst_tag_no_old =$field->asst_tag_no;
    $serial_no_old =$field->serial_no;
    $imei_old =$field->imei;
    $model_old =$field->model;
    $brand_old =$field->brand;
    $mac_address_old =$field->mac_address;
    $specification_old =$field->specification;
    $acquisition_date_old =$field->acquisition_date;
    $warranty_old =$field->warranty;
    $remarks_old =$field->remarks;

    if($location!=$field->location){
        $field='location';$value_old=$_POST;$value_new=$location;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($custodian!=$field->custodian){
        $field='custodian';$value_old=$custodian_old;$value_new=$custodian;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($asst_tag_no!=$field->asst_tag_no){
        $field='asst_tag_no';$value_old=$asst_tag_no_old;$value_new=$asst_tag_no;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($serial_no!=$field->serial_no){
        $field='serial_no';$value_old=$serial_no_old;$value_new=$serial_no;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($imei!=$field->imei){
        $field='imei';$value_old=$imei_old;$value_new=$imei;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($model!=$field->model){
        $field='model';$value_old=$model_old;$value_new=$model;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($brand!=$field->brand){
        $field='brand';$value_old=$brand_old;$value_new=$brand;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($mac_address!=$field->mac_address){
        $field='mac_address';$value_old=$mac_address_old;$value_new=$mac_address;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($specification!=$field->specification){
        $field='specification';$value_old=$specification_old;$value_new=$specification;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($acquisition_date!=$field->acquisition_date){
        $field='acquisition_date';$value_old=$acquisition_date_old;$value_new=$acquisition_date;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($warranty!=$field->warranty){
        $field='warranty';$value_old=$warranty_old;$value_new=$warranty;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    if($remarks!=$field->remarks){
        $field='remarks';$value_old=$remarks_old;$value_new=$remarks;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }

    $jsonresponse->success = true;
    $jsonresponse->message ='Record updated';
    // $jsonresponse->update =$custodian!=$field->custodian;
    // $jsonresponse->field =$field;
    // $jsonresponse->total = "0";
    // $jsonresponse->data = $rec;

    echo json_encode($jsonresponse);
    
?>