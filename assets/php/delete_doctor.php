<?php

require_once __DIR__ .  '/rest/services/DoctorService.class.php';

// Get the selected doctors IDs sent via POST
$selectedDoctors = $_POST['doctors'];

// Instantiate DoctorService
$doctorService = new DoctorService();

try {
    // Delete the selected doctors
    foreach ($selectedDoctors as $doctorId) {
        $doctorService->delete_doctor_by_id($doctorId);
    }

    // Return success response
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Return error response
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

?>
