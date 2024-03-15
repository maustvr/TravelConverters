<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

//start the session
session_start();
require_once 'config.php';		
?>

<!DOCTYPE html>
<head>
	<html lang="en">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Travel Unit Converters</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
</head>
<body>
 	<form id="form" name="myform" form action="saveSearch.php" method="post">

	<div id="heading">
		<h1>Travel Unit Converters</h1>
	</div>

	<br>

	<a href = "javascript:;"  id = "logIn" onclick = "this.href='login.php?weatherloc1='+ document.getElementById('weatherloc1').value + 
	'&weatherloc2='+ document.getElementById('weatherloc2').value + '&timeloc1=' + document.getElementById('timeloc1').value + '&timeloc2=' + document.getElementById('timeloc2').value + '&currone=' + document.getElementById('currone').value + '&curramt=' + document.getElementById('number').value 
	+ '&kmdistance=' + document.getElementById('KmInput').value + '&midistance=' + document.getElementById('MiInput').value 
	+ '&meterdistance=' + document.getElementById('MeterInput').value + '&ftdistance=' + document.getElementById('FtInput').value 
	+ '&kgamt=' + document.getElementById('KgInput').value + '&lbamt=' + document.getElementById('lbInput').value"><b>Log in </b></a>


	<a href = "javascript:;"  id = "createAccount" onclick = "this.href='createAccount.php?weatherloc1='+ document.getElementById('weatherloc1').value + 
	'&weatherloc2='+ document.getElementById('weatherloc2').value + '&timeloc1=' + document.getElementById('timeloc1').value + '&timeloc2=' + document.getElementById('timeloc2').value + '&currone=' + document.getElementById('currone').value +'&curramt=' + document.getElementById('number').value 
	+ '&kmdistance=' + document.getElementById('KmInput').value + '&midistance=' + document.getElementById('MiInput').value 
	+ '&meterdistance=' + document.getElementById('MeterInput').value + '&ftdistance=' + document.getElementById('FtInput').value 
	+ '&kgamt=' + document.getElementById('KgInput').value + '&lbamt=' + document.getElementById('lbInput').value"><b>Create Account </b></a>

	<br>

	<div class="flexContainer">

		<div class="leftcolumn">
			<div class ="weather">
				<div id="tempcompare">
				
					<h2>Compare temperatures in two locations</h2>
					<br>
					<br>
				</div>
				<br>
					<div class ="location">
						<div class ="input">
						
							<label for="weatherloc1">Enter First Weather Location</label><br>
							<input type ="text" id="weatherloc1" class="inputValueA" name ="weatherloc1" placeholder="Enter a city" >
							
							<input id="buttonA" type="button" value="search" class="buttonA">

						</div>
						<div class="display">
							<h3 class="city1">First Location</h3>
							<div class ="middle">
								<div class = "degrees">
									<div class="tempC">°C
									</div>
									
									<div class="tempF">°F
									</div>
									
								</div>
								<h3 class="desc1">description</h3>
								
							</div>
						</div>
					</div>

				<div class ="location">
					<div class ="input">
					<label for="weatherloc2">Enter Second Weather Location</label><br>
						<input type ="text" id="weatherloc2" class="inputValueB" placeholder="Enter a city" name="weatherloc2">
						<input type="button" value="search" class="buttonB">
					</div>
					<div class="display">
						<h3 class="city2">Second Location</h3>
						<div class ="middle">
							<div class = "degrees">
								<div class="temp2"></div>
								<div class="tempC2">°C
						</div>
							<div class="tempF2">°F</div>
							
						</div>
							<div><h3 class="desc2">description</h3>
						</div>
						<br>					
					</div>
				</div>
				</div>		
			</div>
			<br>
			
			<div class ="timedate">
			<div class ="timezone">			
				<h2>Time Zone Comparison</h2>
			
			<div class = "search">
				<table class="timesearch">
					<col class="city">
					<col class="submit">
						<tr>
							<label for="timeloc1" style="color: #00538C;">Enter First Timezone Location</label><br>
							<td id="city"><input type ="text" id='timeloc1' class="inputValue1" placeholder="Enter a city " name="timeloc1"></td>
							<td id ="search"><input type="button" value="search" class="button1"></td>
							<td class="datetime1">Date, Time</td>
						</tr>
				</table>
				<br>
				
				<table class="timesearch">
					<col class="city">
					<col class="submit">
				<tr>
					<label for="timeloc2" style="color: #00538C;">Enter Second Timezone Location</label><br>
					<td id="city"><input type ="text" id='timeloc2' class="inputValue2" placeholder="Enter a city " name="timeloc2"></td>
					<td id ="search"><input type="button" value="search" class="button2"></td>
					<td class="datetime2">Date, Time</td>
				</tr>			
				</table>
				<br>
			</div>
			</div>
			</div>
			
			<div class="currencyconversion">
				<div class="currency-converter">
		
					<h2>Currency Converter</h2>
					<br>

					<div class="field grid-50-50">
		
						<div class="colmun-left">
							<div class="select">
								<label for="currone"  style="color: #00538C;">Select First Currency</label><br>
								<select name="currone" id ='currone' class="currency dropdown" onchange="updatevalue()"></select>
							</div>
						</div>
						<div class="colmun col-right">
							<label for="number" style="color: #00538C;">Enter Amount of First currency</label><br>
							<input type="text" class="form-input" id="number" placeholder="Please enter an amount" onchange="updatevalue()" name="curramt">
						</div>
				</div>

					<div class="field grid-50-50">	  
						<div class="colmun col-left">
							<div class="select">
								<label for="currtwo" style="color: #00538C;">Select Second Currency</label><br>
								<select name="currtwo" id="currtwo" class="currency dropdown" onchange="updatevalue()"></select>
								
							</div>
						</div>
						<div class="colmun col-right">
						<br>
							<input type="text" class="form-input" id="output" placeholder="00000"  name="curresult" onchange="updatevalue()">
						</div>      
					</div>
				</div>
			</div>
			<br>
			<br>
			
			<div class="logins">
			
			</div>
			</div>
			<br>

		<div class="rightcolumn">
		
			<div class="calculators"> 
				<div id="smallheadings"
				<br>
				<h2>Kilometers to Miles</h2>
				</div>
				
				<h3>Please enter a distance in kilometers or miles</h3>
				<table class="unitconverter" name ="unitconverter">
				<col id="column-one">
				<col id="column-two">			
				<tr>
				<td class="unit"><label for="KmInput" style ="font-size:25px">Kilometers:</label></td>			
				<td><input id= "KmInput" class="inputValue" placeholder="Enter a number" name ="kmdistance" oninput= updateMiles()>			
				</tr>			
				<tr>
				<td class="unit"><label for="MiInput" style ="font-size:25px">Miles:</label></td>		
				<td><input id ="MiInput" class="inputValue" placeholder="Enter a number" name="midistance" oninput= updateKm()>
				</tr>
				</table>

				<div id="smallheadings"
				<br>
					<h2>Meters to Feet</h2>
				</div>
				
				<h3>Please enter a distance in meters or feet</h3>
				<table class="unitconverter">
				<col id="column-one">
				<col id="column-two">
				
				<tr>
				
				<td class="unit"><label for="MeterInput" style ="font-size:25px" >Meters:</label></td>
				<td><input id= "MeterInput" class="inputValue" placeholder="Enter a number" name="meterdistance" oninput= updateFeet()>			
				</tr>			
				<tr>
				<td class="unit"><label for="FtInput" style ="font-size:25px">Feet:</label></td>
				<td><input id= "FtInput" class="inputValue" placeholder="Enter a number" name="ftdistance" oninput= updateMeters()>			
				</tr>
				</table>
				
				<div id="smallheadings"
				<br>
					<h2>Kilograms to Pounds</h2>
				</div>
				
				<h3>Please enter a distance in kilograms to pounds</h3>
				<table class="unitconverter">
				<col id="column-one">
				<col id="column-two">
				
				<tr>
				<td class="unit"><label for="KgInput" style ="font-size:25px">Kilograms:</label></td>
				<td><input id= "KgInput" class="inputValue" placeholder="Enter a number" name="kgamt" oninput= updatePounds()>
				</tr>
				<tr>
				<td class="unit"><label for="lbInput" style ="font-size:25px">Pounds:</label></td>
				<td><input id= "lbInput" class="inputValue" placeholder="Enter a number" name="lbamt" oninput= updateKilograms()>
				
				</tr>
				</table>			
				<div id="smallheadings"
				<br>
				<div class="logins">
					<h2 id="loginheadings">Save Search</h2>
						<div class="loginentry">
							<label for="searchName" style="color: #00538C;">Name for Saved Search: </label>
							<input type ="text" id="searchName" class="searchName" name ="searchName" placeholder="Enter a name for your search" >
							<p><input type ="button" id="submit-btn" class="savebutton" value="Save" onclick="submit_button ()" /></p>
						</div>
						<script>
							function submit_button(){
								var btn=document.getElementById('submit-btn');
								btn.setAttribute('type', 'submit');
							}		
						</script>			
					</div>	
				</div>		
			</div>	
			</div>		
		</div>
	</div>
	</div>	
	</form>		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src ="./js/script.js"></script>		
</body>
</html>
