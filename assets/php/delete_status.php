<?php

require_once __DIR__ .  '/rest/services/DoctorService.class.php';

$selectedStatuss = $_POST['Status'];


$StatusService = new StatusService();

try {
    
    foreach ($selectedPatients as $statusId) {
        $StatusService->delete_status_by_id($statusId);
    }

    // Return success response
    echo json_encode(["success" => true]);
} catch (Exception $e) {
    // Return error response
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

?>
