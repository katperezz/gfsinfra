<?php
session_start();
header("Content-type: application/json");
include('class/listing_tbl.php');
// include('db_connPDO.php');
include('PHPExcel-1.8/Classes/PHPExcel.php');

$host="localhost";
$user="root";
$pass="";
$conn;

try {

    $dbh = new PDO("mysql:host=localhost;dbname=assets", $user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    echo $e->getMessage();
}


// require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
function cellColor($cells,$color){
    global $objPHPExcel;
    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => $color),
                'font'  => array(
                                    'bold'  => true,
                                    'color' => array('rgb' => 'FF0000'),
                                    'size'  => 9,
                                    'name'  => 'Verdana'
                                )

                )
            );
}


$sqlselect =  "select*from mobile where status<>'deleted'";

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0); 
$rowCount = 4; 

date_default_timezone_set("Asia/Manila");
$today = date("F j, Y, g:i a"); 

$objPHPExcel->getActiveSheet()->SetCellValue('A1', "GreatFeat Services, Inc. - Inventory");
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Mobile");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "ID");
cellColor('A3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('B3',"location");
cellColor('B3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('C3',"custodian");
cellColor('C3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', "asst_tag_no");
cellColor('D3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', "serial_no");
cellColor('E3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', "imei"); 
cellColor('F3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', "model"); 
cellColor('G3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', "brand"); 
cellColor('H3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', "mac_address"); 
cellColor('I3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', "specification"); 
cellColor('J3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', "acquisition_date"); 
cellColor('K3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('L3', "warranty"); 
cellColor('L3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('M3', "remarks"); 
cellColor('M3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('N3', "status"); 
cellColor('N3', 'CCEEFF');

        $qselect = $dbh->query($sqlselect);
        // $query = $listing->loadAll($s);

        while($row = $qselect->fetch(PDO::FETCH_ASSOC)){    

         $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$row['id']);
         $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$row['location']);
         $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$row['custodian']);
         $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$row['asst_tag_no']);
         $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$row['serial_no']);
         $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$row['imei']);
         $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$row['model']);
         $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$row['brand']);
         $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$row['mac_address']);
         $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$row['specification']);
         $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,$row['acquisition_date']);
         $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount,$row['warranty']);
         $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount,$row['remarks']);
    
    $rowCount++; 
} 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Mobile');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
header('Content-Disposition: attachment;filename="GFSInventory-Mobile.csv"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save('php://output'); 


?>