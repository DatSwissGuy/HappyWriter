<?php

class CustomerModel
{

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getCustomers() {
        $sql = "SELECT * FROM customer";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Customer');

        return $data;
    }

    public function insertIntoCustomer(string $firstname, string $lastname, string $street, string $city, int $zipcode, int $telephone) {
        $sql = "INSERT INTO customer (firstname, lastname, street, city, zipcode, telephone) 
                VALUES (:firstname, :lastname, :street, :city, :zipcode, :telephone)";
        $query = $this->db->prepare($sql);
        // TODO check all types again e.g. zipcode
        $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $query->bindParam(':street', $street, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
        $query->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    }

}