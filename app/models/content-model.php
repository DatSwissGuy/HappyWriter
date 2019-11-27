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

        $data = $query->fetchAll();

        // TODO figure this shit out
        return $data;
    }
}