<?php

require_once __DIR__ . '/../services/PatientService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 

Flight::set('PatientService', new PatientService());
/**
 * @OA\Post(
 *      path="/patients/add",
 *      tags={"patients"},
 *      summary="Add patient",
 *      @OA\Response(
 *           response=200,
 *           description="Patient added successfully"
 *      ),
 *      @OA\RequestBody(
 *          description="Patient details",
 *          @OA\JsonContent(
 *             required={"name", "surname"},
 *             @OA\Property(property="name", type="string", example="Lamija"),
 *             @OA\Property(property="surname", type="string", example="Setic"),
 *          
 *             
 *     
 *           )
 *      ),
 * )
 */

Flight::route('POST /patients/add', function(){
   
    $data = Flight::request()->data->getData();

    try {
        $newPatient = Flight::get('PatientService')->add_patient($data);
        
        Flight::json(["success" => true, "patient" => $newPatient]);
    } catch (Exception $e) {
       
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

/**
 * @OA\Post(
 *      path="/patients/delete",
 *      tags={"patients"},
 *      summary="Delete selected patients",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"patients"},
 *              @OA\Property(
 *                  property="patients",
 *                  type="array",
 *                  @OA\Items(type="string"),
 *                  example={"1", "2", "3"},
 *                  description="Array of patient IDs to delete"
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success response",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=true),
 *              @OA\Property(property="message", type="string", example="Patients deleted successfully")
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Error response",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=false),
 *              @OA\Property(property="error", type="string", example="Error message")
 *          )
 *      )
 * )
 */
Flight::route('POST /patients/delete', function(){
    
    $selectedPatients = Flight::request()->data->getData()['patients'];

    $PatientService = new PatientService();

    try {
       
        foreach ($selectedPatients as $patientId) {
            $PatientService->delete_patient_by_id($patientId); 
        }

       
        Flight::json(["success" => true]);
    } catch (Exception $e) {
        
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

/**
 * @OA\Get(path="/patients", tags={"patients"}, 
 *         summary="Return all patients from the API. ",
 *         @OA\Response( response=200, description="List of patients.")
 * )
 */
Flight::route('GET /patients', function(){
    try {
        $patients = Flight::get('PatientService')->get_all_patients();
        
        Flight::json($patients);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }

});