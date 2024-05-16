<?php
require_once __DIR__ . '/../vendor/flightphp/core/flight/Flight.php'; //putanja za Flight umjesto /vendor/autoload.php , upustvo kaze ako Flight nije instaliran sa composerom vec samo kopiran ide ovako https://docs.flightphp.com/install

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

/*require_once __DIR__ . '/../rest/dao/AuthDao.class.php';
require_once __DIR__ . '/routes/auth_routes.php';*/

Flight::start();



?>