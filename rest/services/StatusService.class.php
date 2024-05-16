<?php
require_once __DIR__ . '/../dao/StatusDao.class.php';
class StatusService {
    private $status_dao;

    public function __construct() {
        $this->status_dao = new StatusDao();
    }

    public function get_status_new() {
        return $this->status_dao->get_status_new();
    }

    public function add_status($status) {
        return $this->status_dao->add($status);
    }

    public function get_status_by_id($status_id) {
        return $this->status_dao->get_status_by_id($status_id);
    }

    public function delete_status_by_id($status_id) {
        return $this->status_dao->delete_status_by_id($status_id);
    }
}