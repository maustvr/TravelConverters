<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
session_start();
require_once 'config.php';
?>

<html lang="en">

<head>
	<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css">	
</head>
<p>
<body>

<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));
		
	$usersTable = "users";
	$savedTable = "savedsearches";	
		
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if($DBConnect === false) {
		print"Unable to connect to the database, error, number:".mysqli_errno();

	} else {
		// Retrieve username and password from the POST request
		$username = mysqli_real_escape_string($DBConnect, $_POST['username']);
		$password = mysqli_real_escape_string($DBConnect, $_POST['password']);
		
		// Prepare SQL statement
		$SQLString = "select * from $usersTable where username = ?";
		$stmt = mysqli_prepare($DBConnect, $SQLString);
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		$QueryResult = mysqli_stmt_get_result($stmt);

		// Check if a user with the given username exists
		if(mysqli_num_rows($QueryResult) == 1) {
			$row = mysqli_fetch_assoc($QueryResult);
			$hash = $row['password'];
			if(password_verify($password, $hash)) {
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $username;
				header("Location: loggedIn.php");
				exit;
			}else {
				header("Location: badLogin.php" );
				exit;
			}
			mysqli_free_result($QueryResult);
			mysqli_stmt_close($stmt);
			mysqli_close($DBConnect);
		} else {
			//If not POST request, redirect to login page
			header("Location: login.php");
			exit;
		}
		}
	}
		?>
	</body>						
</html>
		
		