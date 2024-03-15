<?php error_reporting(E_ALL); ini_set('display_errors', 1); (E_ALL ^ (E_NOTICE | E_DEPRECATED)) ;

	require_once 'config.php';

	$weatherloc1 = '';
	$weatherloc2 = '';
	$timeloc1 = '';
	$timeloc2 = '';
	$currone = ''; 
	$curramt = '';
	$currtwo = '';
	$curresult = '';
	$kmdistance = '';
	$midistance = '';
	$meterdistance = '';
	$ftdistance = '';
	$kgamt = '';
	$lbamt = '';

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($DBConnect === false) {
			print "Unable to connect to the database, error, number:" . mysqli_errno();
		} else {
			$usersTable = "users";
			$savedTable = "savedsearches";
			$username = $_SESSION['username'];
			$search = mysqli_real_escape_string($DBConnect, $_POST['search']);
			$_SESSION['search'] = $search;

			// Prepare statement for user query
			$userSQL = "SELECT * FROM $usersTable WHERE username = ?";
			$stmtUser = mysqli_prepare($DBConnect, $userSQL);
			mysqli_stmt_bind_param($stmtUser, "s", $username);
			mysqli_stmt_execute($stmtUser);
			$userResult = mysqli_stmt_get_result($stmtUser);

			if (mysqli_num_rows($userResult) == 0) {
				print "Incorrect username";
			} else {
				$userData = mysqli_fetch_assoc($userResult);
				$username = $userData['username'];
				$ID = $userData['ID'];
				print "<h3>Welcome $username</h3>";

				// Prepare statement for saved searches query
				$savedSQL = "SELECT * FROM $savedTable WHERE Count = ?";
				$stmtSaved = mysqli_prepare($DBConnect, $savedSQL);
				mysqli_stmt_bind_param($stmtSaved, "s", $search);
				mysqli_stmt_execute($stmtSaved);
				$savedResult = mysqli_stmt_get_result($stmtSaved);

				if ($savedResult === false) {
					print "There was an error";
				} else {
					if (mysqli_num_rows($savedResult) == 0) {
						print "The selected search doesn't exist";
					} else {
						$searchData = mysqli_fetch_assoc($savedResult);

						// Assign values
						$weatherloc1 = $searchData['weatherloc1'];
						$weatherloc2 = $searchData['weatherloc2'];
						$timeloc1 = $searchData['timeloc1'];
						$timeloc2 = $searchData['timeloc2'];
						$currone = $searchData['currone'];
						$currtwo = $searchData['currtwo'];
						$curramt = $searchData['curramt'];
						$curresult = $searchData['curresult'];
						$midistance = $searchData['midistance'];
						$kmdistance = $searchData['kmdistance'];
						$ftdistance = $searchData['ftdistance'];
						$meterdistance = $searchData['meterdistance'];
						$lbamt = $searchData['lbamt'];
						$kgamt = $searchData['kgamt'];
												
					}
				}
			}
			
		mysqli_free_result($userResult);
		mysqli_free_result($savedResult);
		mysqli_stmt_close($stmtUser);
		mysqli_stmt_close($stmtSaved);
		mysqli_close($DBConnect);
		}
	}

?>
<html lang="en">


<head>
	<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/style.css">	
	<title>Saved Searches</title>
</head>

<body>

	<div id="heading">
		<h1>Saved Searches</h1>
	</div>
		<br>
		<a id = "logIn" href="loggedIn.php"><b>Home</b></a>
		<a id = "logIn" href="loggedOut.php"><b>Log Out</b></a>
		<br>

		<div id="weather">
		<div class ="savedlocation">
		<div class="display">
		<div id="smallheadings">
			<br>
			<h2 id ="savedheadings">First Saved Location</h2>
			</div>
			<h2 class="city1"><?php echo $weatherloc1;?></h2>
			<div class ="middle">
				<div class = "degrees">
					<div class="tempC">°C
					</div>
					<div class="tempF">°F
					</div>
				</div>
					<h3 class="desc1">Description</h3>
				</div>
				</div>
				</div>

		<div class ="savedlocation">		
			<div class="display">
				<div id="smallheadings">
				<br>
				<h2>Second Saved Location</h2>
				</div>
				<h2 class="city2"><?php echo $weatherloc2;?></h2>
				<div class ="middle">
					<div class = "degrees">
						<div class="tempC2">°C
						</div>						
						<div class="tempF2">°F
						</div>						
					</div>						
					<div><h3 class="desc2">Description</h3>
					</div>					
				</div>
			</div>
			</div>			
		</div>
		</div>
		
		<div class="timeandcurrency">	
		<div class ="savedtimedate">
			<div id="smallheadings"
			<br>
			<h2>Time Difference</h2>
			</div>		
		<br>
		<table class="savedtimelocation">
			<col class="one">
			<col class="two">				
				<tr>
				<td class="cityname1"><?php echo $timeloc1;?></td>
				<td class="datetime1">dateandtime1</td>
				</tr>				
		
				<tr>
				<td class="cityname2"><?php echo $timeloc2;?></td>
				<td class="datetime2">dateandtime2</td>
				</tr>
				</table>
				<br>
	
		</div>	
		
		
	<div class="currency">

	<div id="smallheadings"
			<br>
			<h2>Currency Exchange</h2>
			</div>
			<br>
			<table class ="savedcurrconverter">
			<col class="curr-one">
			<col class="curr-two">
			
			<tr>
			
			<td class="currency1" id="currone"><?php echo $currone;?></td>
			<td class="curramount" id="number"><?php echo $curramt;?></td>
			</tr> 
			<tr>
			<td class="currency1" id="currtwo"><?php echo $currtwo;?></td>
			<td class="curramount" id="output"><?php echo $curresult;?></td>
			<!--<td class="curramount" id="output" placeholder = "0000"><?php echo $curresult;?></td>-->
			</tr>
		</table>
		</div>		
	</div>
	</div>

	<div class="convertedunits"> 
		<div id="smallheadings"
			<br>
			<h2>Unit Conversions</h2>
			</div>
			</div>
			<br>
			<div class="savedunitconversions">
			
			<table class="unitsconverted">
			<col id="column-one">
			<col id="column-two">
			
			<tr>
			<td class="unit">Kilometers:</td>
			<td><id="kmresult"placeholder = ""><?php echo $kmdistance ?></td>
			</tr>
			
			<tr>
			<td class="unit">Miles:</td>
			<td><id="miresult"placeholder = ""><?php echo $midistance ?> </td>
			</tr>
			</table>
			<table class="unitsconverted">
			<col id="column-one">
			<col id="column-two">
			
			<tr>
			<td class="unit">Meters:</td>
			<td><id="meterresult"placeholder = ""><?php echo $meterdistance ?></td>
			</tr>
			
			<tr>
			<td class="unit">Feet:</td>
			<td><id="ftresult"placeholder = ""><?php echo $ftdistance ?></td>
			</tr>
			</table>
			<table class="unitsconverted">
			<col id="column-one">
			<col id="column-two">
			
			<tr>
			<td class="unit">Kilograms:</td>
			<td><id="kgresult"placeholder = ""><?php echo $kgamt ?></td>
			</tr>
			
			<tr>
			<td class="unit">Pounds:</td>
			<td><id="lbresult"placeholder = ""><?php echo $lbamt?> </td>
			</tr>
			</table>
	</div>		
	
</div>	

</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src ="./js/script.js"></script>
<script>
			var weatherloc1 = "<?php echo $weatherloc1; ?>";
			var weatherloc2 = "<?php echo $weatherloc2; ?>";
			var inputValue1 = "<?php echo "$timeloc1"; ?>";
			var inputValue2 = "<?php echo "$timeloc2"; ?>";

</script>

</body>

</html>