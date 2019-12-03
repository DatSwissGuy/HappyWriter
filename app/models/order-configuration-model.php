<?php

class OrderConfigurationModel
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

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'OrderConfiguration');

        return $data;
    }

    public function create($orderPositionId, $contentId) {
        $sql = "INSERT INTO order_configuration (order_position_id, content_id) 
                VALUES (:orderPositionId, :contentId)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':orderPositionId', $orderPositionId, PDO::PARAM_INT);
        $query->bindParam(':contentId', $contentId, PDO::PARAM_INT);

        $query->execute();
    }
}