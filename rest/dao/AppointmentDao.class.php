<?php
require_once __DIR__ . '/BaseDao.class.php';

class AppointmentDao extends BaseDao {
    public function __construct() {
        parent::__construct("appointments");
    }

    public function add($appointment) {
        return $this->insert('appointments', $appointment);
    }

    public function get_appointments($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT * 
                  FROM appointments
                  WHERE LOWER(patient_id) LIKE CONCAT('%', :search, '%') OR LOWER(doctor_id) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, ['search' => strtolower($search)]);
    }

    public function count_appointments($search) {
        $query = "SELECT COUNT(*) AS count 
                  FROM appointments
                  WHERE LOWER(patient_id) LIKE CONCAT('%', :search, '%') OR LOWER(doctor_id) LIKE CONCAT('%', :search, '%')";
        return $this->query_unique($query, ['search' => strtolower($search)]);
    }

    public function get() {
        return $this->get_appointments(0, PHP_INT_MAX, '', 'appointment_id', 'ASC');
    }

    public function get_appointment_by_id($appointment_id){
        return $this->query_unique("SELECT * FROM appointments WHERE appointment_id = :id", ["id" => $appointment_id]);
    }

    public function delete_appointment_by_id($appointment_id) {
        $this->execute("DELETE FROM appointments WHERE appointment_id = :id", ["id" => $appointment_id]);
    }
}
/*
class Appointment {
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