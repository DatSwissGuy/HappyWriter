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

        $data = $query->fetchAll();

        // TODO figure this shit out
        return $data;
    }
}
