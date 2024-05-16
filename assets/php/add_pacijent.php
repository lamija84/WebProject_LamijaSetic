<?php

require_once __DIR__ .  '/rest/services/PatientService.class.php';

// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

 
$PatientService = new PatientService();

try {
   
    $newPatient = $PatientService->add_patient($data);
    
    echo json_encode(["success" => true, "patient" => $newPatient]);
} catch (Exception $e) {
    // Handle the exception
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
