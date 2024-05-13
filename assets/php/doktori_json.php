<?php
 
require_once __DIR__ .  '/rest/dao/DoctorDao.class.php';
// Create an instance of the DoctorDao class
$doctorDao = new DoctorDao();

// Call the get_doctors_new function to retrieve doctors
$doctors = $doctorDao->get_doctors_new();

// Convert the result to JSON
$jsonData = json_encode($doctors);

// Output the JSON data
echo $jsonData;
?>