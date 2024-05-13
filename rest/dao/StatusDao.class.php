<?php
require_once __DIR__ . '/BaseDao.class.php';
class StatusDao extends BaseDao
{
    public function __construct() {
        parent::__construct("status");
    }

    public function add($status) {
        return $this->insert('status', $status);
    }

    public function get_status_new() {
        $query = "SELECT * FROM status";
        return $this->query($query, []);
    }

    public function get_status_by_id($status_id){
        return $this->query_unique("SELECT * FROM status WHERE id = :id", ["id" => $status_id]);
    }

    public function delete_status_by_id($status_id) {
        $this->execute("DELETE FROM status WHERE id = :id", ["id" => $status_id]);
    }
 
}
