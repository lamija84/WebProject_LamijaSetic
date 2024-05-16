<?php
require_once __DIR__ . '/../services/StatusService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 

Flight::set('StatusService', new StatusService());
/**
 * @OA\Post(
 *      path="/status/add",
 *      tags={"status"},
 *      summary="Add status",
 *      @OA\Response(
 *           response=200,
 *           description="Status added successfully"
 *      ),
 *      @OA\RequestBody(
 *          description="Status details",
 *          @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="na čekanju"),
 *             
 *          
 *             
 *     
 *           )
 *      ),
 * )
 */

Flight::route('POST /status/add', function(){
   
    $data = Flight::request()->data->getData();

    try {
        $newStatus = Flight::get('StatusService')->add_status($data);
        
        Flight::json(["success" => true, "status" => $newStatus]);
    } catch (Exception $e) {
       
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

/**
 * @OA\Get(path="/status", tags={"status"}, 
 *         summary="Return all statuses from the API. ",
 *         @OA\Response( response=200, description="List of statuses.")
 * )
 */
Flight::route('GET /status', function(){
    try {
        $statuses = Flight::get('StatusService')->get_status_new();
        
        Flight::json($statuses);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }

});

