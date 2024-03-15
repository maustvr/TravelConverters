?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
//session_start();
//require_once 'config.php';

?>
<head>
	<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<p>
<body>

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

// Start the session
session_start();
require_once 'config.php';

// Check database connection
if ($DBConnect === false) {
    die("Unable to connect to the database. Error: " . mysqli_connect_error());
}

// Retrieve session variables
$weatherloc1 = $_SESSION['weatherloc1'];
$weatherloc2 = $_SESSION['weatherloc2'];
$timeloc1 = $_SESSION['timeloc1'];
$timeloc2 = $_SESSION['timeloc2'];
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
$username = $_SESSION['username'];

// Prepare and execute SQL query
$SQLString = "SELECT ID FROM users WHERE username = ?";
$stmt = mysqli_prepare($DBConnect, $SQLString);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error executing query: " . mysqli_error($DBConnect));
}

if (mysqli_num_rows($result) == 0) {
    echo "User does not exist.";
    header('refresh:2; url=incorrectloginAuthorization.php');
    exit;
}

$row = mysqli_fetch_assoc($result);
$ID = $row['ID'];

// Insert data into database
$SQLStringInsert = "INSERT INTO savedsearches (user_ID, weatherloc1, weatherloc2, timeloc1, timeloc2, currone, currtwo, curramt, curresult, midistance, kmdistance, ftdistance, meterdistance, lbamt, kgamt, name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmtInsert = mysqli_prepare($DBConnect, $SQLStringInsert);
mysqli_stmt_bind_param($stmtInsert, 'issssssiiiiiiiis', $ID, $weatherloc1, $weatherloc2, $timeloc1, $timeloc2, $currone, $currtwo, $curramt, $curresult, $midistance, $kmdistance, $ftdistance, $meterdistance, $lbamt, $kgamt, $name);

if (mysqli_stmt_execute($stmtInsert)) {
    echo "Your search has been saved.";
    header('refresh:2; url=loggedIn.php');
    exit;
} else {
    echo "There was an error saving your search.";
}

// Clean up
mysqli_stmt_close($stmt);
mysqli_stmt_close($stmtInsert);
mysqli_close($DBConnect);
?>
</body>

</html>




<!--<//?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
//session_start();
//require_once 'config.php';

?>
<head>
	<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<p>
<body>
<?/*php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));
		
	if($DBConnect === false) {
		print"Unable to connect to the database, error, number:".mysqli_errno();
		exit;
	}	

		$usersTable = "users";
		$savedTable = "savedsearches";
		$weatherloc1 = $_SESSION['weatherloc1'];
		$weatherloc2 = $_SESSION['weatherloc2'];
		$timeloc1 = $_SESSION['timeloc1'];
		$timeloc2 = $_SESSION['timeloc2'];
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
		$username = $_SESSION['username'];


		$SQLString = "select * from $usersTable where username = '$username'";
			
		$QueryResult = mysqli_query($DBConnect, $SQLString, );
		$ResultId = mysqli_fetch_assoc($QueryResult);
			if(mysqli_num_rows($QueryResult) == 0){
			
				echo $username;
				print" user does not exist";					
				header('refresh:2; url=incorrectloginAuthorization.php');					
				exit;					
			}
				else 
				$ID = $ResultId['ID'];

				$SQLStringInsert = "INSERT INTO savedsearches (user_ID, weatherloc1, weatherloc2, timeloc1, timeloc2, currone, currtwo, curramt, curresult, midistance, kmdistance, ftdistance, meterdistance, lbamt, kgamt, name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

				$stmt = mysqli_prepare($DBConnect, $SQLStringInsert);
				mysqli_stmt_bind_param($stmt, 'issssssi/*iiiiiiis', $ID, $weatherloc1, $weatherloc2, $timeloc1, $timeloc2, $currone, $currtwo, $curramt, $curresult, $midistance, $kmdistance, $ftdistance, $meterdistance, $lbamt, $kgamt, $name);
				
				if (mysqli_stmt_execute($stmt)) {
					echo "Your search has been saved.";
					header('refresh:2; url=loggedIn.php');
					exit;
				} else {
					echo "There was an error saving your search.";
			
				}

			mysqli_free_result($QueryResult);
			mysqli_close($DBConnect);*/
	
?>

</body>

</html>-->