<?php

class AdminModel
{
    // TODO remove or add "real" login (DB)
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }



}