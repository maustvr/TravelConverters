<?php

session_start();
    $_SESSION['logged_in'] = false;
session_destroy();

echo'You have been logged out.';
header('refresh:2; url=Index.php');
exit;
?>
