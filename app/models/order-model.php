<?php

class OrderModel
{

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getContents() {
        $sql = "SELECT * FROM order";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Order');

        return $data;
    }

    public function create() {
        $sql = "INSERT INTO `order` (`customer_id`, `annotations`) 
                VALUES (NULL, NULL)";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $this->db->lastInsertId();
    }

}