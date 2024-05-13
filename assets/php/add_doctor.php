<?php

require_once __DIR__ .  '/rest/services/DoctorService.class.php';

// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

// Instantiate DoctorService
$doctorService = new DoctorService();

try {
    // Add the doctor
    $newDoctor = $doctorService->add_doctor($data);
    // Output the newly added doctor
    echo json_encode(["success" => true, "doctor" => $newDoctor]);
} catch (Exception $e) {
    // Handle the exception
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
