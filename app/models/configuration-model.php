<?php

require 'app/models/Configuration.php';

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
        $sql = "SELECT * FROM configuration";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Configuration');
        return $data;
    }

    public function getConfigByContentId($configId) {
        $sql = "SELECT * FROM configuration WHERE content_id = :configId";
        $query = $this->db->prepare($sql);
        $query->bindParam(':configId', $configId, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Configuration');
        return $data;
    }

    public function add(int $articleId, int $contentId) {
        $sql = "INSERT INTO configuration (article_id, content_id) 
                VALUES (:articleId, :contentId)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':articleId', $articleId, PDO::PARAM_STR);
        $query->bindParam(':contentId', $contentId, PDO::PARAM_STR);
        $query->execute();
    }
}