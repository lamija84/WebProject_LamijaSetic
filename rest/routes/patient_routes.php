<?php

require_once __DIR__ . '/../services/PatientService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 

Flight::set('PatientService', new PatientService());
/**
 * @OA\Post(
 *      path="/patients/add",
 *      tags={"patients"},
 *      summary="Add patient",
 *  security={
     *          {"ApiKey": {}}   
     *      },
 *      @OA\Response(
 *           response=200,
 *           description="Patient added successfully"
 *      ),
 *      @OA\RequestBody(
 *          description="Patient details",
 *          @OA\JsonContent(
 *         required={"name", "surname","email", "password"},
 *             @OA\Property(property="patient_id", type="string", example="1", description="Patient ID"),
 *             @OA\Property(property="name", type="string", example="Some name",description="Patient name ),
 *             @OA\Property(property="surname", type="string", example="Some surname",description="Patient surname ),
 *             @OA\Property(property="email", type="string", example="example@example.com", description="Patient email address"),
 *             @OA\Property(property="password", type="string", example="some_secret_password", description="Patient password")
 *          
 *             
 *     
 *           )
 *      ),
 * )
 */
Flight::route('POST /add', function() {
    $payload = Flight::request()->data->getData();

    if($payload['first_name'] == NULL || $payload['first_name'] == '') {
        Flight::halt(500, "First name field is missing");
    }

    if($payload['id'] != NULL && $payload['id'] != ''){
        $patient = Flight::get('PatientService')->edit_patient($payload);
    } else {
        unset($payload['id']);
        $patient = Flight::get('PatientService')->add_patient($payload);
    }

    Flight::json(['message' => "You have successfully added the patient", 'data' => $patient]);
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
 *  security={
     *          {"ApiKey": {}}   
     *      },
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
            $PatientService->delete_patient_by_id($patientId); //$patientId['patient_id'];
        }

       
        Flight::json(["success" => true]);
    } catch (Exception $e) {
        
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});
/**
 * @OA\Get(path="/patients", tags={"patients"}, 
 *         summary="Return all patients from the API. ",
 *  security={
     *          {"ApiKey": {}}   
     *      },
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
   /**
     * @OA\Get(
     *      path="/patients/info",
     *      tags={"patients"},
     *      summary="Get patients details",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Patient details"
     *      )
     * )
     */
    Flight::route('GET /patients/info', function() {
    
        Flight::json(Flight::get('PatientService')->get_patient_by_id(Flight::get('user')->patient_id)); //('user')
    });