<?php
 
require_once __DIR__ .  '/../dao/AppointmentDao.class.php';

class AppointmentService {
    private $appointment_dao;

    public function __construct() {
        $this->appointment_dao = new AppointmentDao();
    }

    public function get_all_appointments() {
        return $this->appointment_dao->get();
    }

    public function add_appointment($appointment) {
        return $this->appointment_dao->add($appointment);
    }

    public function get_appointments($offset, $limit, $search, $order_column, $order_direction) {
        return $this->appointment_dao->get_appointments($offset, $limit, $search, $order_column, $order_direction);
    }

    public function count_appointments($search) {
        return $this->appointment_dao->count_appointments($search);
    }

    public function get_appointment_by_id($appointment_id) {
        return $this->appointment_dao->get_appointment_by_id($appointment_id);
    }

    public function delete_appointment_by_id($appointment_id) {
        return $this->appointment_dao->delete_appointment_by_id($appointment_id);
    }

}

/*class Appointment {
    public $appointment_id;
    public $patient_id;
    public $doctor_id;
    public $appointment_date;
    public $status;

    public function __construct($patient_id, $doctor_id, $appointment_date, $status) {
        $this->patient_id = $patient_id;
        $this->doctor_id = $doctor_id;
        $this->appointment_date = $appointment_date;
        $this->status = $status;
    }
}
*/