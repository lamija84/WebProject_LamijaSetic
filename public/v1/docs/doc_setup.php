<?php

/**
 * @OA\Info(
 *   title="API",
 *   description="Web Programming API",
 *   version="1.0",
 *   @OA\Contact(
 *     email="lamija.setic@stu.ibu.edu.ba",
 *     name="Lamija Setic"
 *   )
 * ),
 * @OA\OpenApi(
 *   @OA\Server(
 *       url=BASE_URL
 *   )
 * )
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",            
 *     name="Authentication"  
 *                            
 * 
 * )
 */
//Authorization on swagger
//Autentication header on swagger, to use token that we previously issued
// only way for authenticating the users is on every request we will be sending the authentication header 
// with that particular jwt token and we will check it, 
//try to decoded it, check if its valid and only if its valid we will pass the user to some other methods they want to execute