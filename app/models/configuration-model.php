<?php

class ConfigurationModel
{

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getConfiguration() {
        $sql = "SELECT * FROM order";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Configuration');

        return $data;
    }

    public function insertIntoOrderConfiguration(string $name, string $description, float $price, string $icon) {
        $sql = "INSERT INTO order_configuration (order_position_id, content_id) 
                VALUES (:name, :description, :price, :icon)";
        $query = $this->db->prepare($sql);
        // TODO check types
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':icon', $icon, PDO::PARAM_STR);
    }

}