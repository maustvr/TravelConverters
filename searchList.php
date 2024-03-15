<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

	//start the session
	session_start();
	require_once 'config.php';
	$username = $_SESSION['username'];
	print"Welcome $username";

?>
<!DOCTYPE html>

<head>
	<html lang="en">    
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<title>Select search by ID</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src ="./js/script.js"></script>
</head>

<body>
	
	<h2 id ="loginheadings">Select Search by ID</h2>
	<form method="POST" action="saved.php">
		<p>Select Search: 
			<select name="search">
			<?php 
		
		if($DBConnect === false) {
			print"Unable to connect to the database, error, number:".mysqli_errno();
		}else{
						
			$usersTable = "users";
			$savedTable = "savedsearches";
			$username = $_SESSION['username'];							
			$SQLString = "select * from $usersTable where username = ?";			
			$stmt = mysqli_prepare($DBConnect, $SQLString);
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);

			$QueryResult = mysqli_stmt_get_result($stmt);
			$ResultId = mysqli_fetch_assoc($QueryResult);
			if(mysqli_num_rows($QueryResult) == 0) {
				print"incorrect user name";					
			}else {	
								
				$username = $ResultId['username'];							
				$ID = $ResultId['ID'];
				$SQLString2 ="Select * from $savedTable where user_ID = ?";
				$stmt2 = mysqli_prepare($DBConnect, $SQLString2);
				mysqli_stmt_bind_param($stmt2, "i", $ID );
				mysqli_stmt_execute($stmt2);
				
				$QueryResult2 = mysqli_stmt_get_result($stmt2);
				

				if($QueryResult2 === false) {
				print"There are no records in the database";
	
				}else{							
					print"Here is a list of your searches";
					
					while(($Row = mysqli_fetch_assoc($QueryResult2)) != false) {
						echo "<option value=\"{$Row['Count']}\">{$Row['name']}</option>";
					}//end while
					
				}		
																	
			}
			mysqli_free_result($QueryResult);
			mysqli_free_result($QueryResult2);
			mysqli_stmt_close($stmt);
			mysqli_stmt_close($stmt2);		
		}		
									
		mysqli_close($DBConnect);
	?>
	</select>
		</p>
		<p><input type="submit" class="savebutton" value="Submit" /></p>
	</form>
</body>
</html>
				
			
	
	