<?php

class OrderPositionModel
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

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'OrderPosition');

        return $data;
    }

    public function create(int $articleId, int $orderId) {
        $sql = "INSERT INTO `order_position` (`article_id`, `order_id`) 
                VALUES (:articleId, :orderId)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':articleId', $articleId, PDO::PARAM_INT);
        $query->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $query->execute();

        return $this->db->lastInsertId();
    }



}
