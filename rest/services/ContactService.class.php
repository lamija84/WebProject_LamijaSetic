<?php
require_once __DIR__ .  '/../dao/ContactDao.class.php';
class ContactService {
    private $contact_dao;

    public function __construct() {
        $this->contact_dao = new ContactDao();
    }

    public function get_all_contacts() {
        return $this->contact_dao->get_contacts(0, PHP_INT_MAX, '', 'id', 'ASC');
    }

    public function add_contact($contact) {
        return $this->contact_dao->add($contact);
    }

    public function get_contacts($offset, $limit, $search, $order_column, $order_direction) {
        return $this->contact_dao->get_contacts($offset, $limit, $search, $order_column, $order_direction);
    }

    public function count_contacts($search) {
        return $this->contact_dao->count_contacts($search);
    }

    public function get_contact_by_id($contact_id) {
        return $this->contact_dao->get_contact_by_id($contact_id);
    }

    public function delete_contact_by_id($contact_id) {
        return $this->contact_dao->delete_contact_by_id($contact_id);
    }
}