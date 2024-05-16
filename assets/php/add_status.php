<?php

require_once __DIR__ .  '/rest/services/DoctorService.class.php';
// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

// Instantiate StatusService
$statusService = new StatusService();

try {
    // Add the status
    $newStatus = $statusService->add_status($data);
    // Output the newly added status
    echo json_encode(["success" => true, "status" => $newStatus]);
} catch (Exception $e) {
    // Handle the exception
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
