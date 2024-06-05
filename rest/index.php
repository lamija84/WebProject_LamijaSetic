<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/flightphp/core/flight/Flight.php'; //putanja za Flight umjesto /vendor/autoload.php , upustvo kaze ako Flight nije instaliran sa composerom vec samo kopiran ide ovako https://docs.flightphp.com/install

require_once __DIR__ . '/routes/middleware_routes.php';

require_once __DIR__ . '/../rest/dao/DoctorDao.class.php';
require_once __DIR__ . '/routes/doctor_routes.php';

require_once __DIR__ . '/../rest/dao/StatusDao.class.php';
require_once __DIR__ . '/routes/status_routes.php';

require_once __DIR__ . '/../rest/dao/PatientDao.class.php';
require_once __DIR__ . '/routes/patient_routes.php';

require_once __DIR__ . '/../rest/dao/ContactDao.class.php';
require_once __DIR__ . '/routes/contact_routes.php';

require_once __DIR__ . '/../rest/dao/AppointmentDao.class.php';
require_once __DIR__ . '/routes/appointment_routes.php';

require_once __DIR__ . '/../rest/dao/AuthDao.class.php';
require_once __DIR__ . '/routes/auth_routes.php';

Flight::route('GET /', function(){
  echo 'Hello World!';
});
Flight::start();
/*$env = getenv('DB_NAME');

  if ($env != null) {
      header("Location: /index.html");
  } else {
      header("Location: /WebProject_LamijaSetic_new/index.html");
  }

/* ovdje je poziv klase i pocetne stracnice prema uputstvu sa net-a 
require_once __DIR__ . '/vendor/flightphp/core/flight/Flight.php'; 
require_once __DIR__ . '/rest/dao/DoctorDao.class.php';
 
Flight::route('/', function () {
	include("index.html");
});


Flight::route('/rest/doctors', function () {
  require_once __DIR__ . '/rest/dao/DoctorDao.class.php';
$doctorDao = new DoctorDao();
$doctors = $doctorDao->get_doctors_new();
$jsonData = json_encode($doctors);

echo $jsonData;
});


Flight::start();
*/



?>