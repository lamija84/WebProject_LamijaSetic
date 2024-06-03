<?php

require_once __DIR__ . '/BaseDao.class.php';

class PatientDao extends BaseDao
{

  public function __construct() {
    parent::__construct("patients");
  }

  public function add($patient) {
    return $this->insert('patients', $patient);
  }
  public function get_patients($offset, $limit, $search, $order_column, $order_direction) {
    $query = "SELECT * 
              FROM patients
              WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')
              ORDER BY {$order_column} {$order_direction}
              LIMIT {$offset}, {$limit}";
    return $this->query($query, ['search' => strtolower($search)]);
  }
  public function count_patients($search) {
    $query = "SELECT COUNT(*) AS count 
              FROM patients
              WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')";
    return $this->query_unique($query, ['search' => strtolower($search)]);
  }
  
   public function get_patients_new() {
        $query = "SELECT * 
                  FROM patients";
        return $this->query($query, []);
    }

  
  public function get() {
    return $this->get_patients(0, PHP_INT_MAX, '', 'patient_id', 'ASC');
  }
  public function get_patient_by_id($patient_id){
    $a =  $this->query_unique("SELECT * FROM patients WHERE patient_id = :id", ["id" => $patient_id]);
    print_r($a); die;
  }

  public function delete_patient_by_id($patient_id) {
    $this->execute("DELETE FROM patients WHERE patient_id = :id", ["id" => $patient_id]);
  }
  public function get_all_patients(){
    $query = "SELECT *
              FROM patients;";
    return $this->query($query, []);
}
}