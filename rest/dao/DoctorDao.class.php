<?php
require_once __DIR__ . '/BaseDao.class.php';

class DoctorDao extends BaseDao
{
    public function __construct() {
        parent::__construct("doctors");
    }

    public function add($doctor) {
        return $this->insert('doctors', $doctor);
    }

    public function get_doctors($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT * 
                  FROM doctors
                  WHERE LOWER(name) LIKE CONCAT('%', :search, '%') 
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, ['search' => strtolower($search)]);
    }

    public function get_doctors_new() {
        $query = "SELECT * 
                  FROM doctors";
        return $this->query($query, []);
    }

    public function count_doctors($search) {
        $query = "SELECT COUNT(*) AS count 
                  FROM doctors
                  WHERE LOWER(name) LIKE CONCAT('%', :search, '%')";
        return $this->query_unique($query, ['search' => strtolower($search)]);
    }

    public function get() {
        return $this->get_doctors(0, PHP_INT_MAX, '', 'id', 'ASC');
    }

    public function get_doctor_by_id($doctor_id){
        return $this->query_unique("SELECT * FROM doctors WHERE id = :id", ["id" => $doctor_id]);
    }

    public function delete_doctor_by_id($doctor_id) {
        $this->execute("DELETE FROM doctors WHERE id = :id", ["id" => $doctor_id]);
    }
}


