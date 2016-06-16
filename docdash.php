<?php
include('session.php');
$error=''; // Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['ssn']) || empty($_POST['ID']) || empty($_POST['fName']) || empty($_POST['lName'])
	|| empty($_POST['fatherName']) || empty($_POST['motherName']) || empty($_POST['sex'])
	|| empty($_POST['bdate']) || empty($_POST['address']) || empty($_POST['hPhone'])
	|| empty($_POST['jPhone']) || empty($_POST['mPhone']) || empty($_POST['exam'])
	|| empty($_POST['IDinf']) || empty($_POST['reason']) || empty($_POST['odate'])
	|| empty($_POST['rdate']) || empty($_POST['priority'])) {
$error = "One or more fields are empty!";
}
else
{
	//Insert patient information
	$ssn=$_POST['ssn'];
	$ID=$_POST['ID'];
	$fName=$_POST['fName'];
	$lName=$_POST['lName'];
	$fatherName=$_POST['fatherName'];
	$motherName=$_POST['motherName'];
	$sex=strtolower($_POST['sex']);
	$bdate=$_POST['bdate'];
	$address=$_POST['address'];
	$hPhone=$_POST['hPhone'];
	$jPhone=$_POST['jPhone'];
	$mPhone=$_POST['mPhone'];

	// Connecting to db
	$conn = mysqli_connect("localhost", "root", "", "ehealthdoc");
	
	if ( $sex=="male" || $sex=="m" ){
		$sql = "INSERT INTO `patient` (`patientID`, `commandID`, `pName`, `pSurname`, `Address`, `Work_phone`, `Home_phone`, `Cell_phone`, `Date_of_birth`, `SSN`, `Mother_name`, `Father_name`, `Sex`) "
		."VALUES ( '$ID' , NULL , '$fName' , '$lName' , '$address' , '$jPhone' , '$hPhone' , '$mPhone' , '$bdate' , '$ssn' , '$motherName' , '$fatherName' , '1');";
	}
	else
	{
		$sql = "INSERT INTO `patient` (`patientID`, `commandID`, `pName`, `pSurname`, `Address`, `Work_phone`, `Home_phone`, `Cell_phone`, `Date_of_birth`, `SSN`, `Mother_name`, `Father_name`, `Sex`) "
		."VALUES ( '$ID' , NULL , '$fName' , '$lName', '$address' , '$jPhone' , '$hPhone' , '$mPhone' , '$bdate' , '$ssn' , '$motherName' , '$fatherName' , '0');";
	}
	
	if (mysqli_query($conn, $sql)) {
    //echo "<script type='text/javascript'>alert('Command was scheduled successfully!');</script>";
	//header("location: dashboard.php");
	 
	
	//Insert command information
	$commandID=$_POST['IDinf'];
	$type=$_POST['exam'];
	$reason=$_POST['reason'];
	$odate=$_POST['odate'];
	$rdate=$_POST['rdate'];
	$priority=strtolower($_POST['priority']);
	
	if ( $priority=="emergency" || $priority=="high" ){
		$sql = "INSERT INTO `command` (`commandID`, `patientID`, `Issued`, `Issued_by`, `Reason`, `Recommended`, `Emergency_State`, `Type`) VALUES " 
		."($commandID, $ID, '$odate', '$actual_name' , '$reason', '$rdate', 'yes', '$type');";
	}
	else 
	{
		$sql = "INSERT INTO `command` (`commandID`, `patientID`, `Issued`, `Issued_by`, `Reason`, `Recommended`, `Emergency_State`, `Type`) VALUES " 
		."($commandID, $ID, '$odate', '$actual_name' , '$reason', '$rdate', 'no', '$type');";
	}
	
	if (mysqli_query($conn, $sql)) {
	//all good
	$sql="UPDATE patient SET commandID=$commandID WHERE patientID=$ID";
	mysqli_query($conn, $sql);
	mysqli_close($conn);	
	echo "<script type='text/javascript'>alert('Order added successfully!');</script>";

	}
	
	else {
    $error= "Error: ". mysqli_error($conn);
	}
	
	}
	else {
    $error= "Error: " . mysqli_error($conn);
	}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Order Page</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/mainStyle.css">
	<link rel="stylesheet" href="css/BeatPicker.css">
	<script src="js/jquery-1.11.3.min.js"></script>

	<script src="js/BeatPicker.js"></script>

</head>

<body>


				<!-- =============== HEADER ======================== -->
				<header>
					<div id="logo">
						<span id="heart" class="fa fa-heartbeat"></span>	
						<p id="log">HealthAPP</p>

						<div id="account">
							<span id="user" class="fa fa-user-md"></span>
							<p id="acc"><?php echo $actual_name; ?></p>
						</div>

						<div style="clear: both";></div>
					</div> <!-- end logo div -->
				</header>


				<!-- ============= MENU ==================== -->
					
					<div id="menu">
						<ul>
							<li><a href="docdash.php"><span id="dashicon" class="fa fa-user-plus"></span>ORDER</a></li>
							<li><a href="logout.php"><span id="logouticon" class="fa fa-power-off"></span>LOG OUT</a></li>
						</ul>
					</div>


			<div id="content">
				
				<!-- ===================SUB HEADER  =====================-->
				<div id="subheaderSch">
					<div id="sub-icons">
						<div id="menuBox"><span id="menu-icon" class="fa fa-bars"></span></div>
					</div>  

					<p>ORDER</p>

					<div style="clear: both";></div>
				</div>  <!-- end subheader -->


				<!-- ============== PATIENT INFORMATION ============== -->
			<form method="POST" action="">
				<div id="doc_infoPat">
							<p id="doc_titlePat">PATIENT INFORMATION</p>

							<div id="docInformationPat">
								<label class="norm_color" for="ssn">SSN:</label>
								<label class="norm_color" for="ID">ID:</label>
								<label class="norm_color" for="fName">FIRST NAME:</label>
								<label class="norm_color" for="lName">LAST NAME:</label>
								<label class="norm_color" for="fatherName">FATHER'S NAME:</label>
								<label class="norm_color" for="motherName">MOTHER'S NAME:</label>
								<label class="norm_color" for="sex">SEX:</label>
								<label class="norm_color" for="bdate">DATE OF BIRTH:</label>
								<label class="norm_color" for="address">ADDRESS:</label>
								<label class="norm_color" for="hPhone">HOME PHONE:</label>
								<label class="norm_color" for="jPhone">JOB PHONE:</label>
								<label class="norm_color" for="mPhone">MOBILE PHONE:</label>
								<br>
							</div> 

							

							

							<div id="inputDocPat">
								<input type="text" name="ssn" id="ssn">
								<input type="text" name="ID" id="ID">
								<input type="text" name="fName" id="fName">
								<input type="text" name="lName" id="lName">
								<input type="text" name="fatherName" id="fatherName">
								<input type="text" name="motherName" id="motherName">
								<input type="text" name="sex" id="sex">
								<input type="text" data-beatpicker="true" data-beatpicker-module="clear,icon,footer" name="bdate" id="bdate">
								<input type="text" name="address" id="address">
								<input type="tel" name="hPhone" id="hPhone">
								<input type="tel" name="jPhone" id="jPhone">
								<input type="tel" name="mPhone" id="mPhone">

							</div>

							<!-- CLEAR -->
						<div style="clear: both";></div>

				</div> <!-- end patient information --> 

				
				<!-- ============== ORDER INFORMATION ============== -->


				<div id="doc_info">
					<p id="doc_infoTitle">ORDER INFORMATION</p>

					<div id="informationDoc">
						<label class="norm_color" for="exam">RADIOLOGICAL EXAM:</label>
						<label class="norm_color" for="IDinf">ID:</label>
						<label class="norm_color" for="reason">REASON:</label>
						<label class="norm_color" for="odate">DATE OF ORDER:</label>
						<label class="norm_color" for="rdate">RECOMMENDED DATE:</label>
						<label class="norm_color" for="priority">PRIORITY:</label>
					</div> 


					<div id="inputDocInfo">
								<input type="text" name="exam" id="exam">
								<input type="text" name="IDinf" id="IDinf">
								<input type="text" name="reason" id="reason">
								<input type="text" name="odate" id="odate" data-beatpicker="true" data-beatpicker-module="clear,icon,footer">
								<input type="text" name="rdate" id="rdate" data-beatpicker="true" data-beatpicker-module="clear,icon,footer">
								<input type="text" name="priority" id="priority">
					</div>

					<!-- CLEAR -->
						<div style="clear: both";>								
								<br>
								<p style="color:red;" ><?php echo ($error); ?></p>
						</div>
						
				</div> <!-- end order information  -->

					<div id="bArea">
						<button type="submit" value="ORDER" id="or_btn" name="submit">ORDER</button>		
					</div>
					
			


			</form>
			</div> <!-- end content -->





	
	<!-- ===================== FOOTER ======================== -->

	<footer>
		<p>Copyright &copy; all rights reserved 2015</p>
	</footer>

	<!-- JQUERY SCRIPT -->
	<script>
		$(function(){

		//menu
	$("#menu-icon").click(function() {
	  $("#menu").toggleClass("active");
		});

	$("#menu-icon").click(function() {
	  $("#trigger").toggleClass("active");
		});

	

	


	});
	</script>



</body>
</html>