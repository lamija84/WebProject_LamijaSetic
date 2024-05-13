<?php
 
require_once __DIR__ .  '/rest/dao/PatientDao.class.php';

$PatientDao = new PatientDao();

$patient = $PatientDao->get_patients_new();
// Convert the result to JSON
$jsonData = json_encode($patient);

// Output the JSON data
echo $jsonData;
?>