<?php

require_once __DIR__ . '/../services/AuthService.class.php';
require_once __DIR__ . '/../../vendor/flightphp/core/flight/Flight.php'; 


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('auth_service', new AuthService());

Flight::group('/auth', function() {
    
    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"auth"},
     *      summary="Login to system using email and password",
     *      @OA\Response(
     *           response=200,
     *           description="Patient data and JWT"
     *      ),
     *      @OA\RequestBody(
     *          description="Credentials",
     *          @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", example="example@example.com", description="Patient email address"),
     *              @OA\Property(property="password", type="string", example="some_password", description="Patient password")
     *          )
     *      )
     * )
     */
    Flight::route('POST /login', function() {
        $payload = Flight::request()->data->getData();

        $patient = Flight::get('auth_service')->get_user_by_email($payload['email']); //email is from the actual patient route (extracted frpm payload itself)
        
        //checking password
        if(!$patient || !password_verify($payload['password'], $patient['password']))
            Flight::halt(500, "Invalid username or password");
    


        unset($patient['password']); //i dont want to return not even hashed password to frontend so i removed it 
        
        $jwt_payload = [         //payload that will be hashed
            'user' => $patient, //patient from database
            'iat' => time(), //indicates when this token has been issued
            // If this parameter is not set, JWT will be valid for life. This is not a good approach
            'exp' => time() + (60 * 60 * 24) // valid for one day, exp time of token
        ];
        //payload that we want to encode to our jwt token

        $token = JWT::encode(  //token the authentication to our user
            $jwt_payload,
            Config::JWT_SECRET(), //in config.php
            'HS256' //algorithm that we used to create our token
        );

        Flight::json(
            array_merge($patient, ['token' => $token]) //we return this to our user, we merge patient and we attach token to patient
        );
    });
 /**
     * @OA\Post(
     *      path="/auth/logout",
     *      tags={"auth"},
     *      summary="Logout from the system",
     *      security={
     *          {"ApiKey": {}}   
 
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Success response or exception if unable to verify jwt token"
     *      ),
     * )
     */
    //security=ApiKey: this route is secured by using authentication mehanism
    Flight::route('POST /logout', function() {
        try {
            $token = Flight::request()->getHeader("Authentication"); //getting data from Auth. header
            if(!$token)
                Flight::halt(401, "Missing authentication header");

            $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256')); //try to decode token, we pass token and key that is used to decode that token

            Flight::json([ 
                'jwt_decoded' => $decoded_token,  //returns the user what is actually decoded inside my token
                'user' => $decoded_token->user
            ]);
        } catch (\Exception $e) { //if it fails to decode it
            Flight::halt(401, $e->getMessage());  //401 means that you are unauthenticated
        }
    });
});
  