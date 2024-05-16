
<?php

require_once __DIR__ . '/../services/DoctorService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 
//provjera za ovu datoteku je http://localhost/WebProject_LamijaSetic_new/rest/routes/doctor_routes.php 

Flight::set('DoctorService', new DoctorService());

/**
 * @OA\Post(
 *      path="/doctors/add",
 *      tags={"doctors"},
 *      summary="Add doctor",
 *      @OA\Response(
 *           response=200,
 *           description="Doctor added successfully"
 *      ),
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
 *                  description="Array of doctor IDs to delete"
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


//iz doctors.html u pozivu se proslijeduju id doktora koji su cekirani kao post i to data: { doctors: selectedDoctors }, zato na get data mora biti ovo doctors da zna sta
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
