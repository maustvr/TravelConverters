<?php error_reporting (E_ALL ^ (E_NOTICE | E_DEPRECATED));

    //start the session
    session_start();
    
    $_SESSION["weatherloc1"] = $_GET['weatherloc1'];
    $_SESSION["weatherloc2"] = $_GET['weatherloc2'];
    $_SESSION['timeloc1'] = $_GET['timeloc1'];
    $_SESSION['timeloc2'] = $_GET['timeloc2'];
    $_SESSION['currone'] = $_GET['currone'];
    $_SESSION['curramt'] = $_GET['curramt'];
    $_SESSION['kmdistance'] = $_GET['kmdistance'];
    $_SESSION['midistance'] = $_GET['midistance'];
    $_SESSION['meterdistance'] = $_GET['meterdistance'];
    $_SESSION['ftdistance'] = $_GET['ftdistance'];
    $_SESSION['kgamt'] = $_GET['kgamt'];
    $_SESSION['lbamt'] = $_GET['lbamt'];
?>

<head>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login to your Account</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <form action ="loginAuthorization.php" method = "post">
        <div class="logins">
            <h2 id ="loginheadings">Log in to Your Account</h2>
            <p id="username">User Name <input type="text" name ="username"/></p>
            <p id="password" >password <input type ="password" name ="password"/></p>
            <p><input type ="submit" class = "savebutton" value="Submit" /></p>
            <a id = "loginLink" href="createAccount.php"><b>Click Here to Create a New Account</b></a>
    </form>
</body>


<html>
