<?php

    session_start();
    header("Content-type: application/json");
    include('../class/listing_tbl.php');


	$rec  		  = json_decode($_POST['record'], true);	
	$user  		  = $_POST['user'];	

    echo $_POST['record'];
    $jsonresponse = new stdClass();

	class field{         
        var $id;
        var $disposal_name;
        var $brand;
        var $quantity;
        var $remarks;
	}


    $id = $rec['id'];
    $disposal_name = $rec['disposal_name'];
    $brand = $rec['brand'];
    $quantity = $rec['quantity'];
    $remarks = $rec['remarks'];

    foreach ($listing->CurrIdDisposal($id) as $row) {
        
    $field = new field();  

        $field->id= $row['id'];
        $field->disposal_name= $row['disposal_name'];
        $field->brand= $row['brand'];
        $field->quantity= $row['quantity'];
        $field->remarks= $row['remarks'];

    $curr_item=$field;
    }

    $action = 'update';
    $type   = 'monitor';
	$res=$listing->updateDisposal($id,$disposal_name,$brand,$quantity,$remarks);

	$disposal_name_old =$field->disposal_name;
	$brand_old =$field->brand;
	$quantity_old =$field->quantity;
	$remarks_old =$field->remarks;

    if($disposal_name!=$field->disposal_name){

    	$field='disposal_name';$value_old=$disposal_name_old;$value_new=$disposal_name;$item_id=$id;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);

    }else if($brand!=$field->brand){

    	$field='brand';$value_old=$brand_old;$value_new=$brand;$item_id=$id;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);

    }else    if($quantity!=$field->quantity){

    	$field='quantity';$value_old=$asst_tag_no_old;$value_new=$quantity;$item_id=$id;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);

    }else if($remarks!=$field->remarks){

    	$field='remarks';$value_old=$remarks_old;$value_new=$remarks;$item_id=$id;
		$res=$listing->updateLogs($item_id,$action,$type,$field,$value_old,$value_new,$user);

    }

    $jsonresponse->success = true;
    $jsonresponse->field =$field;
    $jsonresponse->total = "0";
    $jsonresponse->data = $rec;

    echo json_encode($jsonresponse);
    
?>