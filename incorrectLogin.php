<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
session_start();


?>

<html lang="en">


<head>
	<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login to your Account</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<form action ="verifylogin.php" method = "post">

<strong>Incorrect User Name or Password</strong>
<h2 id ="smallheadings">Log in to your Account</h2>
<p>User Name <input type="text" name ="username"/></p>
<p>password <input type ="password" name ="password"/></p>
<p><input type ="submit" class = "savebutton" value="Submit" /></p>
<a id = "savedsearches" href="createAccount1.php"><b>Click Here to Create a New Account</b></a>

<?php
			$weatherloc1 = $_SESSION['weatherloc1'];
			$weatherloc2 = $_SESSION['weatherloc2'];
			$timeloc1 = $_SESSION['timeloc1'];
			$timeloc2 = $_SESSION['timeloc1'];
			$currone = $_SESSION['currone'];
			$currtwo = $_SESSION['currtwo'];
			$curramt = $_SESSION['curramt'];
			$curresult = $_SESSION['curresult'];
			$midistance = $_SESSION['midistance'];
			$kmdistance = $_SESSION['kmdistance'];
			$ftdistance = $_SESSION['ftdistance'];
			$meterdistance = $_SESSION['meterdistance'];
			$lbamt = $_SESSION['lbamt'];
			$kgamt = $_SESSION['kgamt'];
			$name = $_SESSION['name'];

?>


</form>
</body>


<html>
