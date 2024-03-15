<?php
session_start();
error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));
    $servername = " ";
    $username = " ";
    $password = " ";
    $dbname = " ";

    $apiKey1 = '';
    $apiKey2 = '';
    $apiKey3 = '';

    // Define dynamic API endpoints
    $dynamicEndpoint = '';

    // Other configuration variables
    $baseUrl1 = ''; 
    $baseurl2 = '';
    $baseurl3 =  '';   
    $baseurl4 = " ";   

    $DBConnect= mysqli_connect($servername, $username, $password, $dbname);
    if ($DBConnect->connect_error) { 
        die("Connection failed: " . $DBConnect->connect_error); 
    }
?>