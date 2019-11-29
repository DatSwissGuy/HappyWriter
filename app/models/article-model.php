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

    public function getSelectedArticle(string $selected) {
        $sql = "SELECT * FROM article WHERE name = '$selected'";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Article');

        return $data;
    }

    public function insertIntoArticle(string $name, string $description, float $price, string $icon) {
        $sql = "INSERT INTO article (name, description, price, icon) 
                VALUES (:name, :description, :price, :icon)";
        $query = $this->db->prepare($sql);
        // TODO check types
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam('icon', $icon, PDO::PARAM_STR);
    }


}
