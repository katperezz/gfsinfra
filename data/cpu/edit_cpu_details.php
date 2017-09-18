<?php

    session_start();
    header("Content-type: application/json");
    include('../class/cpu.php');
    include('../class/listing_tbl.php');

	$rec  		  = json_decode($_POST['record'], true);	
	$user  		  = $_POST['user'];	

	echo $_POST['record'];
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


    $id = $rec['id'];
    $custodian = $rec['custodian'];
    $location = $rec['location'];
    $asst_tag_no = $rec['asst_tag_no'];
    $serial_no = $rec['serial_no'];
    $model = $rec['model'];
    $brand = $rec['brand'];
    $specification = $rec['specification'];
    $mac_addr_lan = $rec['mac_addr_lan'];
    $mac_addr_wan = $rec['mac_addr_wan'];
    $os = $rec['os'];
    $win10_os_license = $rec['win10_os_license'];
    $win7_os_license = $rec['win7_os_license'];
    $acquisition_date = $rec['acquisition_date'];
    $LTTPS = $rec['LTTPS'];
    $NBD = $rec['NBD'];
    $POW = $rec['POW'];
    $proSupport_IT_tech = $rec['proSupport_IT_tech'];
    $remarks = $rec['remarks'];

    foreach ($cpu->CurrIdCPU($id) as $row) {
        
    $fieldr = new field();  

        $fieldr->id= $row['id'];
        $fieldr->custodian= $row['custodian'];
        $fieldr->location= $row['location'];
        $fieldr->asst_tag_no= $row['asst_tag_no'];
        $fieldr->serial_no= $row['serial_no'];
        $fieldr->model= $row['model'];
        $fieldr->brand= $row['brand'];
        $fieldr->specification= $row['specification'];
        $fieldr->mac_addr_lan= $row['mac_addr_lan'];
        $fieldr->mac_addr_wan= $row['mac_addr_wan'];
        $fieldr->os= $row['os'];
        $fieldr->win10_os_license= $row['win10_os_license'];
        $fieldr->win7_os_license= $row['win7_os_license'];
        $fieldr->acquisition_date= $row['acquisition_date'];
        $fieldr->LTTPS= $row['LTTPS'];
        $fieldr->NBD= $row['NBD'];
        $fieldr->POW= $row['POW'];
        $fieldr->proSupport_IT_tech= $row['proSupport_IT_tech'];
        $fieldr->remarks= $row['remarks'];

    $curr_item=$fieldr;
    }

    $action = 'update';
    $type = 'cpu';
    echo $custodian;
	$res=$cpu->updateCPU($id,$custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$mac_addr_lan,$mac_addr_wan,$os,$win10_os_license,$win7_os_license,$acquisition_date,$LTTPS,$NBD,$POW,$proSupport_IT_tech,$remarks);

    $custodian_old =$fieldr->custodian;
    $location_old =$fieldr->location;
    $asst_tag_no_old =$fieldr->asst_tag_no;
    $serial_no_old =$fieldr->serial_no;
    $model_old =$fieldr->model;
    $brand_old =$fieldr->brand;
    $specification_old =$fieldr->specification;
    $mac_addr_lan_old =$fieldr->mac_addr_lan;
    $mac_addr_wan_old =$fieldr->mac_addr_wan;
    $os_old =$fieldr->os;
    $win10_os_license_old =$fieldr->win10_os_license;
    $win7_os_license_old =$fieldr->win7_os_license;
    $acquisition_date_old =$fieldr->acquisition_date;
    $LTTPS_old =$fieldr->LTTPS;
    $NBD_old =$fieldr->NBD;
    $POW_old =$fieldr->POW;
    $proSupport_IT_tech_old =$fieldr->proSupport_IT_tech;
    $remarks_old =$fieldr->remarks;


    if($custodian!=$fieldr->custodian){
    	$field='custodian';$value_old=$custodian_old;$value_new=$custodian;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($location!=$fieldr->location){
        $field='location';$value_old=$location_old;$value_new=$location;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($asst_tag_no!=$fieldr->asst_tag_no){
        $field='asst_tag_no';$value_old=$asst_tag_no_old;$value_new=$asst_tag_no;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($serial_no!=$fieldr->serial_no){
        $field='serial_no';$value_old=$serial_no_old;$value_new=$serial_no;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($model!=$fieldr->model){
        $field='model';$value_old=$model_old;$value_new=$model;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($brand!=$fieldr->brand){
        $field='brand';$value_old=$brand_old;$value_new=$brand;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($specification!=$fieldr->specification){
        $field='specification';$value_old=$specification_old;$value_new=$specification;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($mac_addr_lan!=$fieldr->mac_addr_lan){
        $field='mac_addr_lan';$value_old=$mac_addr_lan_old;$value_new=$mac_addr_lan;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($mac_addr_wan!=$fieldr->mac_addr_wan){
        $field='mac_addr_wan';$value_old=$mac_addr_wan_old;$value_new=$mac_addr_wan;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($os!=$fieldr->os){
        $field='os';$value_old=$os_old;$value_new=$os;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($win10_os_license!=$fieldr->win10_os_license){
        $field='win10_os_license';$value_old=$win10_os_license_old;$value_new=$win10_os_license;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($win7_os_license!=$fieldr->win7_os_license){
        $field='win7_os_license';$value_old=$win7_os_license_old;$value_new=$win7_os_license;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($acquisition_date!=$fieldr->acquisition_date){
        $field='acquisition_date';$value_old=$acquisition_date_old;$value_new=$acquisition_date;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($LTTPS!=$fieldr->LTTPS){
        $field='LTTPS';$value_old=$LTTPS_old;$value_new=$LTTPS;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($NBD!=$fieldr->NBD){
        $field='NBD';$value_old=$NBD_old;$value_new=$NBD;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($POW!=$fieldr->POW){
        $field='POW';$value_old=$POW_old;$value_new=$POW;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($proSupport_IT_tech!=$fieldr->proSupport_IT_tech){
        $field='proSupport_IT_tech';$value_old=$proSupport_IT_tech_old;$value_new=$proSupport_IT_tech;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($remarks!=$fieldr->remarks){
        $field='remarks';$value_old=$remarks_old;$value_new=$remarks;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }

    $jsonresponse->success = true;
    // $jsonresponse->update =$custodian!=$fieldr->custodian;
    // $jsonresponse->field =$fieldr;
    $jsonresponse->message ='Record updated ';
    // $jsonresponse->total = "0";
    // $jsonresponse->data = $rec;

    echo json_encode($jsonresponse);
    
?>