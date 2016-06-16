<?php
$link = mysql_connect("localhost", "root", "") or die("mysql connection is failure.");
mysql_select_db("ehealthproject") or die("Database does not exists.");
if (isset($_POST['submit'])){
echo ("It is set!");
$username=mysql_escape_string($_POST['uname']);
$password=mysql_escape_string($_POST['pass']);
if (!$_POST['uname'] | !$_POST['pass'])
 {
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('You did not complete all of the required fields')
        window.location.href='index.html'
        </SCRIPT>
		<p> Missing </p>");
exit();
     }
$sql= mysql_query("SELECT * FROM `UserName` WHERE `username` = '$username' AND `pass` = '$password'");
if(mysql_num_rows($sql) > 0)
{
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Login Succesfully!.')
        window.location.href='index.html'
        </SCRIPT>
		<p> Good </p>");
exit();
}
else{
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Wrong username password combination.Please re-enter.')
        window.location.href='index.html'
        </SCRIPT>
		<p> Wrong </p>");
exit();
}
}
else{
	echo ("It is not set :(");
}
?>
