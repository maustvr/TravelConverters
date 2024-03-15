<?php
// Include configuration file
require_once 'config.php';

// Return values as JSON
echo json_encode(array(
    'host1' => $baseUrl1,
    'host2' => $baseurl2,
    'host3' => $baseurl3,
    'host4' => $baseurl4,
    'apiKey2' => $apiKey2
    
));
?>
