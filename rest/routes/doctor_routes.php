
<?php

require_once __DIR__ . '/../services/DoctorService.class.php';
require_once __DIR__ . '/../services/PatientService.class.php';

require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 
//ovo sam dodala jer ne radi Flight (inace najbolje je da prije nego pokrenem pocetnu stranu prvo probam pozvati php datoteke da vidim ima li gresaka, uglavnom je to do putanje ili nedostaje neka klasa)
//npr provjra za ovu datoteku je http://localhost/WebProject_LamijaSetic_new/rest/routes/doctor_routes.php 

Flight::set('DoctorService', new DoctorService());
Flight::set('PatientService', new PatientService());


/**
 * @OA\Post(
 *      path="/doctors/add",
 *      tags={"doctors"},
 *      summary="Add doctor",
 *      @OA\Response(
 *           response=200,
 *           description="Doctor added successfully"
 *      ),
 *  security={
     *          {"ApiKey": {}}   
     *      },
 *      @OA\RequestBody(
 *          description="Doctor details",
 *          @OA\JsonContent(
 *             required={"name", "surname", "department"},
 *             @OA\Property(property="name", type="string", example="Lamija"),
 *             @OA\Property(property="surname", type="string", example="Setic"),
 *             @OA\Property(property="department", type="string", example="Cardiology"),
 *             @OA\Property(property="image", type="string", format="binary", description="The image of the doctor (optional)"),
 *        
 *           )
 *      ),
 * )
 */

Flight::route('POST /doctors/add', function(){
    // Get the data sent via POST
    $data = Flight::request()->data->getData();

    try {
        $newDoctor = Flight::get('DoctorService')->add_doctor($data);
        
        Flight::json(["success" => true, "doctor" => $newDoctor]);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

/**
 * @OA\Get(path="/doctors", tags={"doctors"}, 
 *         summary="Return all doctors from the API. ",
 * security={
     *          {"ApiKey": {}}   
     *      },
 *         @OA\Response( response=200, description="List of doctors.")
 * )
 */
Flight::route('GET /doctors', function(){
    try {
        $doctors = Flight::get('DoctorService')->get_all_doctors();
        
        Flight::json($doctors);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }

});
/**
 * @OA\Post(
 *      path="/doctors/delete",
 *      tags={"doctors"},
 *      summary="Delete selected doctors",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"doctors"},
 *              @OA\Property(
 *                  property="doctors",
 *                  type="array",
 *                  @OA\Items(type="string"),
 *                  example={"1", "2", "3"},
 *                  description="Array of doctors IDs to delete"
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Success response",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="boolean", example=true),
 *              @OA\Property(property="message", type="string", example="Doctors deleted successfully")
 *          )
 *      ),
 *  security={
     *          {"ApiKey": {}}   
     *      },
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

//iz doctors.html u pozivu se proslijeduju id doktora koji su cekirani kao post i to data: { doctors: selectedDoctors }, zato na get data mora biti ovo doctors da zna st
Flight::route('POST /doctors/delete', function(){
    $selectedDoctors = Flight::request()->data->getData()['doctors'];

    $DoctorService = new DoctorService();

    try {
        foreach ($selectedDoctors as $doctorId) {
            $DoctorService->delete_doctor_by_id($doctorId);
        }

        Flight::json(["success" => true]);
    } catch (Exception $e) {
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});
/**
     * @OA\Get(
     *      path="/doctors/details",
     *      tags={"doctors"},
     *      summary="Get doctor details",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Doctor details"
     *      )
     * )
     */
    Flight::route('GET /doctors/details', function() {
        Flight::json(Flight::get('PatientService')->get_patient_by_id(Flight::get('user')->patient_id)); //('user')
    });

