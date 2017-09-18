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


$sqlselect =  "select*from laptop";

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0); 
$rowCount = 4; 

date_default_timezone_set("Asia/Manila");
$today = date("F j, Y, g:i a"); 

$objPHPExcel->getActiveSheet()->SetCellValue('A1', "GreatFeat Services, Inc. - Inventory");
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "Laptop");
$objPHPExcel->getActiveSheet()->SetCellValue('A3', "ID");
cellColor('A3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('B3',"Custodian");
cellColor('B3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('C3',"Location");
cellColor('C3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', "Asset Tag no");
cellColor('D3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', "Serial No");
cellColor('E3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', "Model"); 
cellColor('F3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', "Brand"); 
cellColor('G3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', "mac_address_lan"); 
cellColor('H3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', "mac_address_wan"); 
cellColor('I3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', "specification"); 
cellColor('J3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', "OS"); 
cellColor('K3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('L3', "OS_license"); 
cellColor('L3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('M3', "acquisition_date"); 
cellColor('M3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('N3', "LTTPS"); 
cellColor('N3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('O3', "NBD"); 
cellColor('O3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('P3', "POW"); 
cellColor('P3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('Q3', "proSupport_IT_tech"); 
cellColor('Q3', 'CCEEFF');
$objPHPExcel->getActiveSheet()->SetCellValue('R3', "remarks"); 
cellColor('R3', 'CCEEFF');


        $qselect = $dbh->query($sqlselect);
        // $query = $listing->loadAll($s);

        while($row = $qselect->fetch(PDO::FETCH_ASSOC)){    
         $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$row['id']);
         // cellColor('A'.$rowCount, 'F28A8C');
         $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$row['custodian']);    
         $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$row['location']);
         $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$row['asst_tag_no']);
         $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$row['serial_no']);
         $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$row['model']);         
         $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$row['brand']);         
         $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$row['mac_address_lan']); 
         $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$row['mac_address_wan']);  
         $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$row['specification']);     
         $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,$row['OS']);         
         $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount,$row['OS_license']);        
         $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount,$row['acquisition_date']);  
         $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount,$row['LTTPS']);         
         $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount,$row['NBD']);         
         $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount,$row['POW']);         
         $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount,$row['proSupport_IT_tech']);
         $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount,$row['remarks']);          
    
    $rowCount++; 
} 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Laptop');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
header('Content-Disposition: attachment;filename="GFSInventory-Laptop.csv"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save('php://output'); 


?>