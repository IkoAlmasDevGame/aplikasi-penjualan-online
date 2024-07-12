<?php 
namespace model;

class Transaction {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
}
?>