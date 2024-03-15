<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
session_start();
require_once 'config.php';
?>

<?php
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if($DBConnect === false) {
			print"Unable to connect to the database, error, number:".mysqli_errno();

		} else {
				
				$usersTable = "users";
				$savedTable = "savedsearches";
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
				$_SESSION['meterdistance '] = $meterdistance;
				$_SESSION['lbamt'] = $lbamt;
				$_SESSION['kgamt'] = $kgamt;
				$_SESSION['name'] = $name;
				
				$username = $_SESSION['username'];
				$SQLString = "select * from $usersTable where username = ?";
				$stmt = mysqli_prepare($DBConnect, $SQLString);
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
					
				$QueryResult = mysqli_stmt_get_result($stmt);
				$ResultId = mysqli_fetch_assoc($QueryResult);
				if(mysqli_num_rows($QueryResult) == 0) {
					echo $username;
					print"project handler user does not exist";					
					header('refresh:2; url=incorrectloginAuthorization.php');					
					exit;					
				} else {
								
					$ID = $ResultId['ID'];						
					$SQLStringInsert = "insert into savedsearches(user_ID,weatherloc1, weatherloc2, timeloc1, timeloc2, currone, currtwo,
					curramt, curresult, midistance, kmdistance, ftdistance, meterdistance,
					lbamt, kgamt, name) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

					$stmtInsert = mysqli_prepare($DBConnect, $SQLStringInsert);
					mysqli_stmt_bind_param($stmtInsert, "issssssiiiiiiiis", $ID, $weatherloc1, $weatherloc2, $timeloc1, $timeloc2, 
						$currone, $currtwo, $curramt, $curresult, $midistance, $kmdistance, $ftdistance,
					$meterdistance, $lbamt, $kgamt, $name);	

					$QueryResult2 = mysqli_stmt_execute($stmtInsert);
					if($QueryResult2 === false) {
						print"there was an error";
					}else {
						print"Your search has been saved";
						header('refresh: 2; URL=loggedIn.php');
						exit;
					}
				}
			}
		}				
		mysqli_free_result($QueryResult);
		mysqli_stmt_close($stmt);
		mysqli_stmt_close($stmtInsert);
		mysqli_close($DBConnect);			
	?>
