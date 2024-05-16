<?php

require_once __DIR__ .  '/rest/services/AppointmentService.class.php';

// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

 
$AppointmentService = new AppointmentService();

try {
     
    $newAppointmen = $AppointmentService->add_appointment($data);
     
    echo json_encode(["success" => true, "appointment" => $newAppointmen]);
} catch (Exception $e) {
     
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
