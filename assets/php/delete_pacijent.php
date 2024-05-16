<?php

require_once __DIR__ .  '/rest/services/PatientService.class.php';


$selectedPatients = $_POST['patients'];


$PatientService = new PatientService();

try {
    
    foreach ($selectedPatients as $patientId) {
        $PatientService->delete_patient_by_id($patientId);
    }

    // Return success response
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Return error response
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

?>
