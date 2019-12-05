<?php

class ContentModel
{

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getContents() {
        $sql = "SELECT * FROM content";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Content');

        return $data;
    }

    public function getContentsByConfiguration(int $articleId) {
        $sql = "SELECT content.id, content.name, content.description, content.price, content.icon FROM content JOIN configuration 
                ON content.id = configuration.content_id 
                WHERE configuration.article_id = :articleId";
        $query = $this->db->prepare($sql);
        $query->bindParam(':articleId', $articleId, PDO::PARAM_INT);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Content');

        return $data;


    }

    public function add(string $name, string $description, float $price, string $icon) {
        $sql = "INSERT INTO content (name, description, price, icon) 
                VALUES (:name, :description, :price, :icon)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':icon', $icon, PDO::PARAM_STR);

        $query->execute();

        return $this->db->lastInsertId();
    }

}