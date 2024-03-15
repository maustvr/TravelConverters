<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
session_start();
require_once 'config.php';

?>

<head>
	<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login to your Account</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>

<form action ="verifylogin.php" method = "post">
	<h2 id ="smallheadings">Log in to your Account</h2>
	<p id="username">User Name <input type="text" name ="username"/></p>
	<p id="password" >password <input type ="password" name ="password"/></p>
	<p><input type ="submit" class = "savebutton" value="Submit" /></p>
	<a id = "savedsearches" href="createAccount1.php"><b>Click Here to Create a New Account</b></a>
</form>
<?php

			$weatherloc1 = mysqli_real_escape_string($DBConnect, $_POST['weatherloc1']);
			$weatherloc2 = mysqli_real_escape_string($DBConnect, $_POST['weatherloc2']);
			$timeloc1 = mysqli_real_escape_string($DBConnect, $_POST['timeloc1']);
			$timeloc2 = mysqli_real_escape_string($DBConnect, $_POST['timeloc2']);
			$currone = mysqli_real_escape_string($DBConnect, $_POST['currone']); 
			$currtwo = mysqli_real_escape_string($DBConnect, $_POST['currtwo']);
			$curramt = mysqli_real_escape_string($DBConnect, $_POST['curramt']);
			$curresult = mysqli_real_escape_string($DBConnect, $_POST['curresult']);
			$midistance = mysqli_real_escape_string($DBConnect, $_POST['midistance']);
			$kmdistance = mysqli_real_escape_string($DBConnect, $_POST['kmdistance']);
			$ftdistance = mysqli_real_escape_string($DBConnect, $_POST['ftdistance']);
			$meterdistance = mysqli_real_escape_string($DBConnect, $_POST['meterdistance']);
			$lbamt = mysqli_real_escape_string($DBConnect, $_POST['lbamt']);
			$kgamt = mysqli_real_escape_string($DBConnect, $_POST['kgamt']);
			$name = mysqli_real_escape_string($DBConnect, $_POST['searchName']);
			$_SESSION['weatherloc1'] = $weatherloc1;
			$_SESSION['weatherloc2'] = $weatherloc2;
			$_SESSION['timeloc1'] = $timeloc1;
			$_SESSION['timeloc2'] = $timeloc2;
			$_SESSION['currone'] = $currone;
			$_SESSION['currtwo'] = $currtwo;
			$_SESSION['curramt'] = $curramt;
			$_SESSION['curresult'] = $curresult;
			$_SESSION['midistance'] = $midistance;
			$_SESSION['kmdistance'] = $kmdistance;
			$_SESSION['ftdistance'] = $ftdistance;
			$_SESSION['meterdistance'] = $meterdistance;
			$_SESSION['lbamt'] = $lbamt;
			$_SESSION['kgamt'] = $kgamt;
			$_SESSION['name'] = $name;
			$_SESSION['save'] = "true";
			
			
?>
</body>

<html>
