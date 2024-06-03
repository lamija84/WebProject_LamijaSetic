<?php


require_once __DIR__ . '/../services/ContactService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 
Flight::set('ContactService', new ContactService());

/**
 * @OA\Post(
 *      path="/contacts/add",
 *      tags={"contacts"},
 *      summary="Add contact",
 *      @OA\Response(
 *           response=200,
 *           description="Contact added successfully"
 *      ),
 *  security={
     *          {"ApiKey": {}}   
     *      },
 *      @OA\RequestBody(
 *          description="Contact details",
 *          @OA\JsonContent(
 *             required={"name", "email", "subject", "message"},
 *             @OA\Property(property="name", type="string", example="Lamija"),
 *             @OA\Property(property="email", type="string", example="setic@gmail.com"),
 *             @OA\Property(property="subject", type="string", example="Pregled"),
 *             @OA\Property(property="message", type="string", example="Hitan pregled impaktiranih osmica."),
 *        
 *           )
 *      ),
 * )
 */

Flight::route('POST /contacts/add', function(){
    // Get the data sent via POST
    $data = Flight::request()->data->getData();

    try {
        $newContact = Flight::get('ContactService')->add_contact($data);
        
        Flight::json(["success" => true, "contact" => $newContact]);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});