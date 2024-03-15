<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
session_start();
require_once 'config.php';

/*?>
<!DOCTYPE html>


<head>
	<html lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src ="./js/script.js"></script>
</head>

<body>

<?php */
	if($_SERVER["REQUEST_METHOD"]== "POST") {
		if($DBConnect === false) {
			print"Unable to connect to the database, error, number:".mysqli_errno();
		}else{
						
			$usersTable = "users";
			$savedTable = "savedsearches";
			$username = mysqli_real_escape_string($DBConnect, $_POST['username']);
			$password = mysqli_real_escape_string($DBConnect, $_POST['password']);
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
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
			$SQLString = "select * from $usersTable where username = ?";
			$stmt = mysqli_prepare($DBConnect, $SQLString);
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			
			$QueryResult = mysqli_stmt_get_result($stmt);
			$ResultId = mysqli_fetch_assoc($QueryResult);
			if(mysqli_num_rows($QueryResult) == 0){
				header("Location: incorrectlogin.php");
				exit;					
			} else {
				$PW = $ResultId['password'];
				$username = $ResultId['username'];
				if (password_verify($password, $PW)) {							
					$ID = $ResultId['ID'];
					$_SESSION['logged_in'] = true;
					header("Location: handler.php");
					exit;							
				 }else {
					print"incorrect user name or password";
					header("Location: incorrectlogin.php");
					exit;						
				}
			}
		}						
		mysqli_free_result($QueryResult);
		mysqli_stmt_close($stmt);
	}					
	mysqli_close($DBConnect);
?>
