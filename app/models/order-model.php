<?php

class OrderModel
{

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getContents() {
        $sql = "SELECT * FROM order";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'Order');

        return $data;
    }

    public function create() {
        $sql = "INSERT INTO `order` (`customer_id`, `annotations`) 
                VALUES (NULL, NULL)";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $this->db->lastInsertId();
    }

    public function getOrderedContentsById(int $orderId) {
        $sql = "SELECT `order_configuration`.`content_id`, `content`.`name`, `content`.`price` FROM order_configuration
                JOIN `order_position` ON `order_position`.`id` = `order_configuration`.`order_position_id`
                JOIN `order` ON `order`.`id` = `order_position`.`order_id`
                JOIN `content` ON `content`.`id` = `order_configuration`.`content_id`
                WHERE `order`.`id` = :orderId";
        $query = $this->db->prepare($sql);
        $query->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $query->execute();

        $data = $query->fetchAll();

        return $data;
    }

    public function updateCurrentOrder(int $customerId, int $orderId, string $annotations) {
        $sql = "UPDATE `order` SET `customer_id` = :customerId, `annotations` = :annotations
                WHERE `id` = :orderId";
        $query = $this->db->prepare($sql);
        $query->bindParam(':customerId', $customerId, PDO::PARAM_INT);
        $query->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $query->bindParam(':annotations', $annotations, PDO::PARAM_STR);
        $query->execute();
    }
}