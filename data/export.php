<?php
$conn = mysql_connect("localhost","root","");
mysql_select_db("assets",$conn);

$filename = "toy_csv.csv";
$fp = fopen('php://output', 'w');

$query = "SELECT location FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='toy'";
$result = mysql_query($query);
while ($row = mysql_fetch_row($result)) {
	$header[] = $row[0];
}

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$query = "SELECT * FROM monitor";
$result = mysql_query($query);
while($row = mysql_fetch_row($result)) {
	fputcsv($fp, $row);
}
exit;
?>