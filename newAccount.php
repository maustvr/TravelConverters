<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

	//start the session
	session_start();
	require_once 'config.php';
?>

<head>
	<html lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create a new Account</title>
</head>
<body>
	<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));
	if($_SERVER['REQUEST_METHOD']=="POST") {
		if($DBConnect === false) {
			print"Unable to connect to the database, error, number:".mysqli_errno();	
		} else {
			$usersTable = "users";
			$username = mysqli_real_escape_string($DBConnect, $_POST['username']);
			$password = mysqli_real_escape_string($DBConnect, $_POST['password']);
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$SQLString = "select * from $usersTable where username = ?";
			$stmt = mysqli_prepare($DBConnect, $SQLString);
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			$QueryResult = mysqli_stmt_get_result($stmt);

			if(mysqli_num_rows($QueryResult) > 0) {
				print"<h2>Your account has been added<br><br></h2>";
				$_SESSION['username'] = $username; 
				header('refresh:2; url=loggedIn.php');
				exit;
			} else {
				$SQLString2 ="insert into $usersTable(username, password) values(?, ?)";
				$stmt2 = mysqli_prepare($DBConnect, $SQLString2);
				mysqli_stmt_bind_param($stmt2, "ss", $username, $hash);
				$success = mysqli_stmt_execute($stmt2);

				if($success) {
					print"<h2>Your account has been added<br><br></h2>";
					$_SESSION['username'] = $username; 
					header('refresh:2; url=loggedIn.php');
					exit;
				} else {
					print"<h2>Error creating account.<br><br></h2>";
						header('refresh:2; url=createAccount1.php');
						exit;					
				}
			}
		}	
		mysqli_free_result($QueryResult);
		mysqli_stmt_close($stmt);
		mysqli_stmt_close($stmt2);
		mysqli_close($DBConnect);
	} else {
		header("Location: createAccount1.php");
		exit;
	}
	
?>			
</body>			
<html>