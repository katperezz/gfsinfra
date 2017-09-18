<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');
    include('../class/usb.php');


	$rec  		  = json_decode($_POST['record'], true);	
	$user  		  = $_POST['user'];	

    $jsonresponse = new stdClass();

	class field{         
        var $id;
        var $name;
        var $item_desc;
        var $date_deployed;
        var $deployed_by;
        var $date_returned;
        var $returned_to;
        var $warranty_date;
	}

    $id = $rec['id'];
    $name = $rec['name'];
    $item_desc = $rec['item_desc'];
    $date_deployed = $rec['date_deployed'];
    $deployed_by = $rec['deployed_by'];
    $date_returned = $rec['date_returned'];
    $returned_to = $rec['returned_to'];
    $warranty_date = $rec['warranty_date'];
    $asst_tag_no = "USB-".$id;

    foreach ($usb->CurrIdUsb($id) as $row) {
        
    $fieldr = new field();  
        $fieldr->id= $row['id'];
        $fieldr->name= $row['name'];
        $fieldr->item_desc= $row['item_desc'];
        $fieldr->date_deployed= $row['date_deployed'];
        $fieldr->deployed_by= $row['deployed_by'];
        $fieldr->date_returned= $row['date_returned'];
        $fieldr->returned_to= $row['returned_to'];
        $fieldr->warranty_date= $row['warranty_date'];

    $curr_item=$fieldr;
    }

    $action = 'update';
    $type = 'usb';
	$res=$usb->updateUsb($id,$name,$item_desc,$date_deployed,$deployed_by,$date_returned,$returned_to,$warranty_date);

    $name_old =$fieldr->name;
    $item_desc_old =$fieldr->item_desc;
    $date_deployed_old =$fieldr->date_deployed;
    $deployed_by_old =$fieldr->deployed_by;
    $date_returned_old =$fieldr->date_returned;
    $returned_to_old =$fieldr->returned_to;
    $warranty_date_old =$fieldr->warranty_date;

    if($name!=$fieldr->name){
    	$field='name';$value_old=$name_old;$value_new=$name;$item_id=$asst_tag_no;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($item_desc!=$fieldr->item_desc){
        $field='item_desc';$value_old=$item_desc_old;$value_new=$item_desc;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($date_deployed!=$fieldr->date_deployed){
        $field='date_deployed';$value_old=$date_deployed_old;$value_new=$date_deployed;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($deployed_by!=$fieldr->deployed_by){
        $field='deployed_by';$value_old=$deployed_by_old;$value_new=$deployed_by;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($date_returned!=$fieldr->date_returned){
        $field='date_returned';$value_old=$date_returned_old;$value_new=$date_returned;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($returned_to!=$fieldr->returned_to){
        $field='returned_to';$value_old=$returned_to_old;$value_new=$returned_to;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }else if($warranty_date!=$fieldr->warranty_date){
        $field='warranty_date';$value_old=$warranty_date_old;$value_new=$warranty_date;$item_id=$asst_tag_no;
        $res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);
    }

    $jsonresponse->success = true;
    $jsonresponse->message ='Record updated';
    $jsonresponse->data = $rec;

    echo json_encode($jsonresponse);
    
?>