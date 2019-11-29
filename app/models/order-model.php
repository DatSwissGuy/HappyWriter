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

    // TODO is customer id needed as an insert, it's an FK.
    public function insertIntoOrder(int $customerId, string $annotations) {
        $sql = "INSERT INTO order (customer_id, annotations)  
                VALUES (:customerId, :annotations)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':customerId', $customerId, PDO::PARAM_STR);
        $query->bindParam(':annotations', $annotations, PDO::PARAM_STR);
    }

}