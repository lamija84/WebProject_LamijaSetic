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
 * )
 */