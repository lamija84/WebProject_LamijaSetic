<?php
require_once __DIR__ . '/../services/AppointmentService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php';
Flight::set('AppointmentService', new AppointmentService());


/**
 * @OA\Post(
 *      path="/appointments/add",
 *      tags={"appointments"},
 *      summary="Add appointment",
 *      @OA\RequestBody(
 *          description="Appointment details",
 *          @OA\JsonContent(
 *             required={"doctor_id", "patient_id", "appointment_date", "status"},
 *             @OA\Property(property="doctor_id", type="integer", example=1),
 *             @OA\Property(property="patient_id", type="integer", example=2),
 *             @OA\Property(property="appointment_date", type="string", format="date", example="2021-03-20"),
 *             @OA\Property(property="status", type="integer", type="integer", example=1)
 *          )
 *      ),
 *      @OA\Response(
 *           response=200,
 *           description="Appointment added successfully"
 *      )
 * )
 */



Flight::route('POST /appointments/add', function(){
    // Get the data sent via POST
    $data = Flight::request()->data->getData();

    try {
        $newAppointment = Flight::get('AppointmentService')->add_appointment($data);
        
        Flight::json(["success" => true, "appointment" => $newAppointment]);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }
});

//ne treba na stranici da se prikaze
Flight::route('GET /appointments', function(){
    try {
        $appointments = Flight::get('Appointmentservice')->get_all_appointments();
        
        Flight::json ($appointments);
    } catch (Exception $e) {
        // Handle the exception
        Flight::json(["success" => false, "error" => $e->getMessage()]);
    }

});

