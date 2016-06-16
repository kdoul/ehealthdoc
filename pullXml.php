<?php 
if (isset($_GET['key'])) { //if key is set
	if( $_GET['key']=="allhailthegreatlama" ){ //if key is correct
	// Connect to db
	//$conn = mysqli_connect("localhost", "root", "", "ehealthdoc");
	$link = mysql_connect('localhost','root','') or die('Cannot connect to the DB');
	mysql_select_db('ehealthdoc',$link) or die('Cannot select the DB');
	
	//Get the patients
	$sql = "SELECT patient.* FROM patient,command WHERE patient.patientID=command.patientID AND command.isPulled=0;";	

	$result = mysql_query($sql,$link) or die('Error:  '.$query);
	
	$patients = array();
	if(mysql_num_rows($result)) {
		while($patient = mysql_fetch_assoc($result)) {
			$patients[] = array('patient'=>$patient);
		}
	}
	
	//Get the commands
	$sql = "SELECT * FROM command WHERE isPulled=0;";	
	
	$result = mysql_query($sql,$link) or die('Error:  '.$query);
	
	$commands = array();
	if(mysql_num_rows($result)) {
		while($command = mysql_fetch_assoc($result)) {
			$commands[] = array('command'=>$command);
		}
	}
	
	header('Content-type: text/xml');
		echo '<data>';
		echo '<patients>';
		
		foreach($patients as $index => $patient) {
			if(is_array($patient)) {
				foreach($patient as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		
		echo '</patients>';
		
		echo '<commands>';
		
		foreach($commands as $index => $command) {
			if(is_array($command)) {
				foreach($command as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</commands>';
		
		echo '</data>';
	
	
		if( isset($_GET['notest'])){
		//Not testing, update command.isPulled	
		
		$sql="UPDATE command SET isPulled=1 WHERE isPulled=0;";
		mysql_query($sql,$link) or die('Error:  '.$query);
		
		}
	}
	else{
		echo 'Invalid Key!';
	}
	
}
else {
	echo 'Invalid Parameters!';
}

?>