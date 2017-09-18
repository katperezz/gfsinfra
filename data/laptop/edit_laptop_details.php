<?php

    session_start();
    header("Content-type: application/json");
    include('../class/laptop.php');
    include('../class/listing_tbl.php');


	$rec  		  = json_decode($_POST['record'], true);	
	$user  		  = $_POST['user'];	

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

	$id = $rec['id'];
	$custodian = $rec['custodian'];
	$location = $rec['location'];
	$asst_tag_no = $rec['asst_tag_no'];
	$serial_no = $rec['serial_no'];
	$model = $rec['model'];
	$brand = $rec['brand'];
    $mac_address_lan = $rec['mac_address_lan'];
    $mac_address_wan = $rec['mac_address_wan'];
    $specification = $rec['specification'];
    $OS = $rec['OS'];
    $OS_license = $rec['OS_license'];
    $acquisition_date = $rec['acquisition_date'];
    $LTTPS = $rec['LTTPS'];
    $NBD = $rec['NBD'];
    $POW = $rec['POW'];
    $proSupport_IT_tech = $rec['proSupport_IT_tech'];
	$acquisition_date = $rec['acquisition_date'];
	$remarks = $rec['remarks'];

    foreach ($laptop->CurrIdLaptop($id) as $row) {
        
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
        $field->OS= $row['OS'];
        $field->OS_license= $row['OS_license'];
        $field->acquisition_date= $row['acquisition_date'];
        $field->LTTPS= $row['LTTPS'];
        $field->NBD= $row['NBD'];
        $field->POW= $row['POW'];
        $field->proSupport_IT_tech= $row['proSupport_IT_tech'];
        $field->remarks= $row['remarks'];

    $curr_item=$field;
    }

    $action = 'update';
    $type = 'laptop';
	$res=$laptop->updateLaptop($id,$custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$mac_address_lan,$mac_address_wan,$specification,$OS,$OS_license,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks);

    $custodian_old =$field->custodian;
    $location_old =$field->location;
    $asst_tag_no_old =$field->asst_tag_no;
    $serial_no_old =$field->serial_no;
    $model_old =$field->model;
    $brand_old =$field->brand;
    $mac_address_lan_old =$field->mac_address_lan;
    $mac_address_wan_old =$field->mac_address_wan;
    $specification_old =$field->specification;
    $OS_old =$field->OS;
    $OS_license_old =$field->OS_license;
    $acquisition_date_old =$field->acquisition_date;
    $LTTPS_old =$field->LTTPS;
    $NBD_old =$field->NBD;
    $POW_old =$field->POW;
    $proSupport_IT_tech_old =$field->proSupport_IT_tech;
    $remarks_old =$field->remarks;

    if($custodian!=$field->custodian){
    	$field='custodian';$value_old=$custodian_old;$value_new=$custodian;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }
    // else if($location!=$field->location){
    //     $field='location';$value_old=$location_old;$value_new=$location;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($asst_tag_no!=$field->asst_tag_no){
    //     $field='asst_tag_no';$value_old=$asst_tag_no_old;$value_new=$asst_tag_no;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($serial_no!=$field->serial_no){
    //     $field='serial_no';$value_old=$serial_no_old;$value_new=$serial_no;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($model!=$field->model){
    //     $field='model';$value_old=$model_old;$value_new=$model;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($brand!=$field->brand){
    //     $field='brand';$value_old=$brand_old;$value_new=$brand;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($mac_address_lan!=$field->mac_address_lan){
    //     $field='mac_address_lan';$value_old=$mac_address_lan_old;$value_new=$mac_address_lan;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($mac_address_wan!=$field->mac_address_wan){
    //     $field='mac_address_wan';$value_old=$mac_address_wan_old;$value_new=$mac_address_wan;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($specification!=$field->specification){
    //     $field='specification';$value_old=$specification_old;$value_new=$specification;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($OS!=$field->OS){
    //     $field='OS';$value_old=$OS_license;$value_new=$OS;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($OS_license!=$field->OS_license){
    //     $field='OS_license';$value_old=$OS_license_old;$value_new=$OS_license;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($acquisition_date!=$field->acquisition_date){
    //     $field='acquisition_date';$value_old=$acquisition_date_old;$value_new=$acquisition_date;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($LTTPS!=$field->LTTPS){
    //     $field='LTTPS';$value_old=$LTTPS_old;$value_new=$LTTPS;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($NBD!=$field->NBD){
    //     $field='NBD';$value_old=$NBD_old;$value_new=$NBD;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($POW!=$field->POW){
    //     $field='POW';$value_old=$POW_old;$value_new=$POW;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($proSupport_IT_tech!=$field->proSupport_IT_tech){
    //     $field='proSupport_IT_tech';$value_old=$proSupport_IT_tech_old;$value_new=$proSupport_IT_tech;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }else if($remarks!=$field->remarks){
    //     $field='remarks';$value_old=$remarks_old;$value_new=$remarks;$item_id=$asst_tag_no;
    //     $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    // }

    $jsonresponse->success = true;
    $jsonresponse->message ='Record updated';
    // $jsonresponse->update =$custodian!=$field->custodian;
    // $jsonresponse->field =$field;
    // $jsonresponse->total = "0";
    // $jsonresponse->data = $rec;

    echo json_encode($jsonresponse);
    
?>