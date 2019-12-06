<?php

class ArticleModel
{

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getArticles() {
        $sql = "SELECT * FROM article";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Article');
        return $data;
    }

    public function getArticleById(int $id) {
        $sql = "SELECT * FROM article WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Article');
        return $data;
    }

    public function add(string $name, string $description, float $price, string $icon) {
        $sql = "INSERT INTO article (name, description, price, icon) 
                VALUES (:name, :description, :price, :icon)";
        $query = $this->db->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':icon', $icon, PDO::PARAM_STR);
        $query->execute();
    }

}
