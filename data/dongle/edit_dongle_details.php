<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/dongle.php');


	$rec  		  = json_decode($_POST['record'], true);	
	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
        var $id;
        var $custodian;
        var $location;
        var $item_description;
        var $deployed_date;
        var $deployed_by;
        var $returned_date;
        var $returned_to;
	}

    $id = $rec['id'];
    $custodian = $rec['custodian'];
    $location = $rec['location'];
    $item_description = $rec['item_description'];
    $deployed_date = $rec['deployed_date'];
    $deployed_by = $rec['deployed_by'];
    $returned_date = $rec['returned_date'];
    $returned_to = $rec['returned_to'];
    $asst_tag_no = "USB-".$id;

    foreach ($dongle->CurrIdDongle($id) as $row) {
        
    $fieldr = new field();  
        $fieldr->id= $row['id'];
        $fieldr->custodian= $row['custodian'];
        $fieldr->location= $row['location'];
        $fieldr->item_description= $row['item_description'];
        $fieldr->deployed_date= $row['deployed_date'];
        $fieldr->deployed_by= $row['deployed_by'];
        $fieldr->returned_date= $row['returned_date'];
        $fieldr->returned_to= $row['returned_to'];


    $curr_item=$fieldr;
    }

    $action = 'update';
    $type = 'dongle';
	$res=$dongle->updateDongle($id,$custodian,$location,$item_description,$deployed_date,$deployed_by,$returned_date,$returned_to);

    $custodian_old =$fieldr->custodian;
    $location_old =$fieldr->location;
    $item_description_old =$fieldr->item_description;
    $deployed_date_old =$fieldr->deployed_date;
    $deployed_by_old =$fieldr->deployed_by;
    $returned_date_old =$fieldr->returned_date;
    $returned_to_old =$fieldr->returned_to;

    if($custodian!=$fieldr->custodian){
    	$field='custodian';$value_old=$custodian_old;$value_new=$custodian;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($location!=$fieldr->location){
        $field='location';$value_old=$location_old;$value_new=$location;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($item_description!=$fieldr->item_description){
        $field='item_description';$value_old=$item_description_old;$value_new=$item_description;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($deployed_date!=$fieldr->deployed_date){
        $field='deployed_date';$value_old=$deployed_date_old;$value_new=$deployed_date;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($deployed_by!=$fieldr->deployed_by){
        $field='deployed_by';$value_old=$deployed_by_old;$value_new=$deployed_by;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($returned_date!=$fieldr->returned_date){
        $field='returned_date';$value_old=$returned_date_old;$value_new=$returned_date;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($returned_to!=$fieldr->returned_to){
        $field='returned_to';$value_old=$returned_to_old;$value_new=$returned_to;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }

    $jsonresponse->success = true;
    $jsonresponse->message ='Record updated';
    $jsonresponse->data = $rec;

    echo json_encode($jsonresponse);
    
?>