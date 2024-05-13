<?php

require_once __DIR__ .  '/rest/services/DoctorService.class.php';

// Get the data sent via POST
$data = json_decode(file_get_contents("php://input"), true);

// Instantiate ContactService
$contactService = new ContactService();

try {
    // Add the contact
    $newContact = $contactService->add_contact($data);
    // Output the newly added contact
    echo json_encode(["success" => true, "contact" => $newContact]);
} catch (Exception $e) {
    // Handle the exception
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
