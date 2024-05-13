<?php
require_once __DIR__ .  '/../dao/DoctorDao.class.php';

class DoctorService {
    private $doctor_dao;

    public function __construct() {
        $this->doctor_dao = new DoctorDao();
    }

    public function get_all_doctors() {
        return $this->doctor_dao->get();
    }

    public function add_doctor($doctor) {
        return $this->doctor_dao->add($doctor);
    }

    public function get_doctors($offset, $limit, $search, $order_column, $order_direction) {
        return $this->doctor_dao->get_doctors($offset, $limit, $search, $order_column, $order_direction);
    }

    public function count_doctors($search) {
        return $this->doctor_dao->count_doctors($search);
    }

    public function get_doctor_by_id($doctor_id) {
        return $this->doctor_dao->get_doctor_by_id($doctor_id);
    }

    public function delete_doctor_by_id($doctor_id) {
        return $this->doctor_dao->delete_doctor_by_id($doctor_id);
    }
}





