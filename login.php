
<?php
session_start(); // Starting Session
$error=''; // Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is empty";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id, password and database as a parameter
$connection = mysqli_connect("localhost", "root", "", "ehealthdoc");
// To protect MySQL injection for Security purposes
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($connection , "SELECT * FROM login WHERE pass='$password' AND userName='$username'");
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: docdash.php"); // Redirecting To Other Page
} else { 
$error = "Username or Password is invalid";
}
mysqli_close($connection); // Closing Connection
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Doc App Login</title>
	<link rel="stylesheet" href="css/mainStyle.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body id="loginBody">
	<div id="loginBox">
		<div id="loginHead">
			<div id="logoBox"><span id="heart" class="fa fa-heartbeat"></span>	
			<p id="logHead">HealthAPP Doc</p>
		</div>
		
		<div id="inputs">

					<!-- Username Input -->
			<form action="" method="POST">
			<div id="IconBox">
				<span id="userIcon" class="fa fa-user"></span>
			</div>
			<input type="text" placeholder="USERNAME" name="username">

					<!-- CLEAR -->
			<div style="clear: both";></div>


					<!-- Password Input -->

			<div id="IconBox">
				<span id="lockIcon" class="fa fa-lock"></span>
			</div>
			<input type="password" placeholder="PASSWORD" name="password">

					<!-- CLEAR -->
			<div style="clear: both";></div>

			<button type="submit" value="login" id="lg_btn" name="submit">LOGIN</button>
			</form>	
			<br>
			<center><p class="errorText" id="logHead" style="color:red; font-size:140%; "><?php echo ($error); ?></p></center>
		</div>		
		</div>
	</div>
</body>
</html>