<?php
require_once __DIR__ . '/BaseDao.class.php';
class ContactDao extends BaseDao
{
    public function __construct() {
        parent::__construct("contacts");
    }

    public function add($contact) {
        return $this->insert('contacts', $contact);
    }

    public function get_contacts($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT * 
                  FROM contacts
                  WHERE LOWER(name) LIKE CONCAT('%', :search, '%') 
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, ['search' => strtolower($search)]);
    }

    public function count_contacts($search) {
        $query = "SELECT COUNT(*) AS count 
                  FROM contacts
                  WHERE LOWER(name) LIKE CONCAT('%', :search, '%')";
        return $this->query_unique($query, ['search' => strtolower($search)]);
    }

    public function get_contact_by_id($contact_id){
        return $this->query_unique("SELECT * FROM contacts WHERE id = :id", ["id" => $contact_id]);
    }

    public function delete_contact_by_id($contact_id) {
        $this->execute("DELETE FROM contacts WHERE id = :id", ["id" => $contact_id]);
    }
}
