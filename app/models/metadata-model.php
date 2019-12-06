<?php

class MetadataModel
{

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getMetadata() {
        $sql = "SELECT * FROM metadata";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll();
        return [
            'name' => $data[array_search('name', array_column($data, 'key'))]->value,
            'version' => $data[array_search('version', array_column($data, 'key'))]->value
        ];
    }

}
