<?php

    session_start();
    header("Content-type: application/json");
    include('../class/monitor.php');
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
	$model = $rec['model'];
	$brand = $rec['brand'];
	$specification = $rec['specification'];
	$acquisition_date = $rec['acquisition_date'];
	$warranty = $rec['warranty'];
	$remarks = $rec['remarks'];

    foreach ($monitor->CurrIdMonitor($id) as $row) {
        
    $fieldr = new field();  

        $fieldr->id= $row['id'];
        $fieldr->custodian= $row['custodian'];
        $fieldr->location= $row['location'];
        $fieldr->asst_tag_no= $row['asst_tag_no'];
        $fieldr->serial_no= $row['serial_no'];
        $fieldr->model= $row['model'];
        $fieldr->brand= $row['brand'];
        $fieldr->specification= $row['specification'];
        $fieldr->acquisition_date= $row['acquisition_date'];
        $fieldr->warranty= $row['warranty'];
        $fieldr->remarks= $row['remarks'];

    $curr_item=$fieldr;
    }

    $action = 'update';
    $type = 'monitor';
	$res=$monitor->updateMonit($id,$custodian,$location,$asst_tag_no,$serial_no,$model,$brand,$specification,$acquisition_date,$warranty,$remarks);

	$custodian_old =$fieldr->custodian;
	$location_old =$fieldr->location;
	$asst_tag_no_old =$fieldr->asst_tag_no;
	$serial_no_old =$fieldr->serial_no;
	$model_old =$fieldr->model;
	$brand_old =$fieldr->brand;
	$specification_old =$fieldr->specification;
	$acquisition_date_old =$fieldr->acquisition_date;
	$warranty_old =$fieldr->warranty;
	$remarks_old =$fieldr->remarks;

    if($custodian!=$fieldr->custodian){
    	$field='custodian';$value_old=$custodian_old;$value_new=$custodian;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($location!=$fieldr->location){
    	$field='location';$value_old=$location_old;$value_new=$location;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else    if($asst_tag_no!=$fieldr->asst_tag_no){
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
    }else if($acquisition_date!=$fieldr->acquisition_date){
    	$field='acquisition_date';$value_old=$acquisition_date_old;$value_new=$acquisition_date;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($warranty!=$fieldr->warranty){
    	$field='warranty';$value_old=$warranty_old;$value_new=$warranty;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($remarks!=$fieldr->remarks){
    	$field='remarks';$value_old=$remarks_old;$value_new=$remarks;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }

    $jsonresponse->success = true;
    // $jsonresponse->update =$custodian!=$fieldr->custodian;
    // $jsonresponse->field =$fieldr;
    // $jsonresponse->message =$rec['location'];
    $jsonresponse->message ='Record updated';
    // $jsonresponse->total = "0";
    $jsonresponse->data = $rec;

    echo json_encode($jsonresponse);
    
?>