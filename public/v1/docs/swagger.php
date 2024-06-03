
<?php

require __DIR__ . '/../../../vendor/autoload.php';

if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1'){
    /*define('BASE_URL', 'http://localhost/WebProject_LamijaSetic_new/');   //zbog ovog ne radi swagger- do base urla je
} else {
   */ define('BASE_URL', 'https://king-prawn-app-yg9m8.ondigitalocean.app/');
}

error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../../../rest/routes', './']);
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>