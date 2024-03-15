<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

	$weatherloc1 = isset($_SESSION['weatherloc1']) ? $_SESSION['weatherloc1'] : null;
	$weatherloc2 = isset($_SESSION['weatherloc2']) ? $_SESSION['weatherloc2'] : null;
	$timeloc1 = isset($_SESSION['timeloc1']) ? $_SESSION['timeloc1'] : null;
	$timeloc2 = isset($_SESSION['timeloc2']) ? $_SESSION['timeloc2'] : null;
	$currone = isset($_SESSION['currone']) ? $_SESSION['currone'] : null;
	$currtwo = isset($_SESSION['currtwo']) ? $_SESSION['currtwo'] : null;
	$curramt = isset($_SESSION['curramt']) ? $_SESSION['curramt'] : null;
	$curresult = isset($_SESSION['curresult']) ? $_SESSION['curresult'] : null;
	$midistance = isset($_SESSION['midistance']) ? $_SESSION['midistance'] : null;
	$kmdistance = isset($_SESSION['kmdistance']) ? $_SESSION['kmdistance'] : null;
	$ftdistance = isset($_SESSION['ftdistance']) ? $_SESSION['ftdistance'] : null;
	$meterdistance = isset($_SESSION['meterdistance']) ? $_SESSION['meterdistance'] : null;
	$lbamt = isset($_SESSION['lbamt']) ? $_SESSION['lbamt'] : null;
	$kgamt = isset($_SESSION['kgamt']) ? $_SESSION['kgamt'] : null;
	$name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
	$save = isset($_SESSION['save']) ? $_SESSION['save'] : null;

	require_once 'config.php';
?>
	
<head>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src ="./js/script.js"></script>	
</head>
<body>

	<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));
	if($DBConnect == false )	{
		print"Unable to connect to the database, error, number:".mysqli_errno();
	}
		else {
			if($_SERVER["REQUEST_METHOD"]=='POST') {
				$usersTable = "users";
				$savedTable = "savedsearches";			
				$username = mysqli_real_escape_string($DBConnect, $_POST['username']);
				$password = mysqli_real_escape_string($DBConnect, $_POST['password']);

				$SQLString = "select * from $usersTable where username = ?";
					$stmt = mysqli_prepare($DBConnect, $SQLString);
					mysqli_stmt_bind_param($stmt, "s", $username);
					mysqli_stmt_execute($stmt);
					$QueryResult = mysqli_stmt_get_result($stmt);

				if(mysqli_num_rows($QueryResult) == 1) {							
					$row = mysqli_fetch_assoc($QueryResult);
					$hashed_password = $row['password'];
					if(password_verify($password, $hashed_password)) {
						$_SESSION['logged_in'] = true;
						$_SESSION['username'] = $username;
						if ($save == "true" ){
							header("Location: handler.php");
							exit;
						} else {
						header("Location: loggedIn.php");
						exit;
						}
					}
				} else {
					header("Location: badLogin.php");
					exit;
				}
				mysqli_free_result($QueryResult);
				mysqli_stmt_close($stmt);
				mysqli_close($DBConnect);
			} else {
				header(Location: login.php);
				exit;
			}

		}
		
	?>
</body>
</html>