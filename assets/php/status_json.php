<?php
 

require_once __DIR__ .  '/rest/dao/DoctorDao.class.php';

$StatusDao = new StatusDao();

$status = $StatusDao->get_status_new();
// Convert the result to JSON
$jsonData = json_encode($status);

// Output the JSON data
echo $jsonData;
?>