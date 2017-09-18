<?php
include_once("../config.php");

$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM monitor WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$emp_name = $res['employee_name'];
	$position = $res['position'];
	$dept = $res['department'];
	$asset = $res['asset'];
	$asset_tag_num = $res['asset_tag_num'];
	$asset_brand = $res['asset_brand'];
	$asset_serial = $res['asset_serial'];
	$asset_model = $res['asset_model'];
	$recieved = $res['recieved_by'];
	$releaser = $res['released_by'];
	$date = $res['date_released'];

}

?>

<html>
	<head>
		<title>GFS Asset Accountability Form</title>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css"/>
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		
		<style>
			@media print {
			  #printPageButton, #backbtn {
				display: none;
			  }
			  
			  .cutting-line {
				margin-top: 30% !important;
				}
			}
			
			.strong {
				font-weight: bolder;
				width: 20%;
			}
			
			.cutting-line {
				border-top: 1px dashed #000;
				margin-top: 50px;
				margin-bottom: 50px;
			}
			
			
		</style>
	</head>
	<body>
		<div class="container">
			<h1>
				Asset Accountability Form
				
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-default" onclick="window.history.back()" id="backbtn">Back</button>
					<button type="button" class="btn btn-primary" onclick="window.print()" id="printPageButton">Print</button>
				</div>
				
			</h1>
			<table class="table table-bordered">
				<tr>
					<td class="strong">Employee Name</td>
					<td><?php echo $emp_name; ?></td>
					<td class="strong">Position</td>
					<td><?php echo $position; ?></td>
				</tr>
				<tr>
					<td class="strong">Department</td>
					<td><?php echo $dept; ?></td>
					<td class="strong">Brand</td>
					<td><?php echo $asset_brand; ?></td>
				</tr>
			</table>
			
			<table class="table table-bordered">
				<tr>
					<td class="strong">Asset</td>
					<td><?php echo $asset; ?></td>
					<td class="strong">Model</td>
					<td><?php echo $asset_model; ?></td>
				</tr>
				<tr>
					<td class="strong">Serial Number:</td>
					<td><?php echo $asset_serial; ?></td>
					<td class="strong">Asset Tag Number</td>
					<td><?php echo $asset_tag_num; ?></td>
				</tr>
			</table>
			
			<table class="table table-bordered">
				<tr>
					<td class="strong">Recieved By:</td>
					<td><?php echo $recieved; ?></td>
					<td class="strong">Date</td>
					<td><?php echo $date; ?></td>
				</tr>
			</table>
			
			<table class="table table-bordered">
				<tr>
					<td class="strong">Released By:</td>
					<td><?php echo $releaser; ?></td>
					<td class="strong">Date</td>
					<td><?php echo $date; ?></td>
				</tr>
			</table>
			
			<hr class="cutting-line">
			
			<h1>
				Asset Accountability Form
			</h1>
			<table class="table table-bordered">
				<tr>
					<td class="strong">Employee Name</td>
					<td><?php echo $emp_name; ?></td>
					<td class="strong">Position</td>
					<td><?php echo $position; ?></td>
				</tr>
				<tr>
					<td class="strong">Department</td>
					<td><?php echo $dept; ?></td>
					<td class="strong">Brand</td>
					<td><?php echo $asset_brand; ?></td>
				</tr>
			</table>
			
			<table class="table table-bordered">
				<tr>
					<td class="strong">Asset</td>
					<td><?php echo $asset; ?></td>
					<td class="strong">Model</td>
					<td><?php echo $asset_model; ?></td>
				</tr>
				<tr>
					<td class="strong">Serial Number:</td>
					<td><?php echo $asset_serial; ?></td>
					<td class="strong">Asset Tag Number</td>
					<td><?php echo $asset_tag_num; ?></td>
				</tr>
			</table>
			
			<table class="table table-bordered">
				<tr>
					<td class="strong">Recieved By:</td>
					<td><?php echo $recieved; ?></td>
					<td class="strong">Date</td>
					<td><?php echo $date; ?></td>
				</tr>
			</table>
			
			<table class="table table-bordered">
				<tr>
					<td class="strong">Released By:</td>
					<td><?php echo $releaser; ?></td>
					<td class="strong">Date</td>
					<td><?php echo $date; ?></td>
				</tr>
			</table>
		</div>
		
		
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>