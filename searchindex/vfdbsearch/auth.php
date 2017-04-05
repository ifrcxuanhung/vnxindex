<?php 

	error_reporting(E_ERROR | E_PARSE);	

	$admin = "admin";

	$admin_pw = "admin";



	session_start();

	

if (isset($_POST['user']) && isset($_POST['pass'])) {



	$username = $_POST['user'];

	$password = $_POST['pass'];

	if (($username == $admin) && ($password ==$admin_pw)) {

		$_SESSION['admin'] = $username;

		$_SESSION['admin_pw'] = $password;

	}

	header("Location: index.php");

} elseif ((isset($_SESSION['admin']) && isset($_SESSION['admin_pw']) &&$_SESSION['admin'] == $admin && $_SESSION['admin_pw'] == $admin_pw ) || (getenv("REMOTE_ADDR")=="")) {



} else {

	

	?>

	<html>

	<head>

	<title>Sphider Pro Bot Admin Login</title>

		<LINK REL=STYLESHEET HREF="main.css" TYPE="text/css">

	</head>



	<body>

	<center>

	<br><br>

	

	<fieldset style="width:30%;"><legend><b>Sphider Pro Bot Admin Login</b></legend>

	<form action="auth.php" method="post">

	

	<table>

	<tr><td>Username</td><td><input type="text" name="user"></td></tr>

	<tr><td>Password</td><td><input type="password" name="pass"></td></tr>

	<tr><td></td><td><input type="submit" value="Log in" id="submit"></td>

	</tr></table>

	</form>

	</fieldset>

	</center>

	</body>

	</html>

	<?php 

	exit();

}




$syst=$_GET['syst'];
if ($syst==1) {
	unlink('install.php');
}

include "../settings/db_admin.php";



?>