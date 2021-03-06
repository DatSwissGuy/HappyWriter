CREATE TABLE `metadata`
(
    `key`   varchar(255) NOT NULL,
    `value` varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `metadata` (`key`, `value`)
VALUES ('name', 'Happy Writer Webshop');
INSERT INTO `metadata` (`key`, `value`)
VALUES ('version', '1.0');

CREATE TABLE `article`
(
    `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name`        varchar(255)  DEFAULT NULL,
    `description` varchar(255)  DEFAULT NULL,
    `price`       decimal(5, 2) DEFAULT NULL,
    `icon`        varchar(255)  DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `article` (`id`, `name`, `description`, `price`, `icon`)
VALUES (1, 'Holzetui', 'Ein Etui aus Holz', 15.00, 'Holzetui.jpg'),
       (2, 'Stoffetui', 'Ein Etui aus Stoff', 10.00, 'Stoffetui.jpg');

CREATE TABLE `content`
(
    `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name`        varchar(255)  DEFAULT NULL,
    `description` varchar(255)  DEFAULT NULL,
    `price`       decimal(5, 2) DEFAULT NULL,
    `icon`        varchar(255)  DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `content` (`id`, `name`, `description`, `price`, `icon`)
VALUES (1, 'Bleistift', 'Ein Bleistift aus Holz', 1.50, 'Bleistift.jpg'),
       (2, 'Feder', 'Der klassische \"Fuelli\"', 10.00, 'Feder.jpg'),
       (3, 'Lineal', 'Ein kleiner Lineal, 15cm lang', 5.00, 'Lineal.jpg'),
       (4, 'Marker', 'Gelber Leuchtstift', 2.00, 'Marker.jpg'),
       (5, 'Papier', '250 Blatt A4', 7.50, 'Papier.jpg'),
       (6, 'Zirkel', 'Ein Zirkel mit maximaler Spannweite von 30cm.', 15.50, 'Zirkel.jpg'),
       (7, 'Spitzer', 'Spitzer fuer Bleistifte', 3.50, 'Spitzer.jpg'),
       (8, 'Schere', 'Eine kleine Schere', 6.50, 'Schere.jpg'),
       (9, 'Radiergummi', 'Ein Radiergummi für Tinte und Bleistift', 2.00, 'Radiergummi.jpg');

CREATE TABLE `configuration`
(
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT,
    `article_id` int(11) unsigned NOT NULL,
    `content_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `article_id` (`article_id`),
    KEY `content_id` (`content_id`),
    CONSTRAINT `configuration_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
    CONSTRAINT `configuration_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `configuration` (`id`, `article_id`, `content_id`)
VALUES (1, 1, 1),
       (2, 1, 3),
       (3, 1, 5),
       (4, 1, 7),
       (5, 1, 9),
       (6, 2, 1),
       (7, 2, 2),
       (8, 2, 4),
       (9, 2, 6),
       (10, 2, 8);

CREATE TABLE `customer`
(
    `id`             int(11) unsigned NOT NULL AUTO_INCREMENT,
    `firstname`      varchar(45)               DEFAULT NULL,
    `lastname`       varchar(45)               DEFAULT NULL,
    `street`         varchar(45)               DEFAULT NULL,
    `city`           varchar(45)               DEFAULT NULL,
    `zipcode`        int(4)                    DEFAULT NULL,
    `telephone`      varchar(10)               DEFAULT NULL,
    `customer_since` timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `order`
(
    `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
    `customer_id` int(11) unsigned          DEFAULT NULL,
    `date`        timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `annotations` varchar(255)              DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `customer_id` (`customer_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `order_position`
(
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT,
    `order_id`   int(11) unsigned NOT NULL,
    `article_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `order_id` (`order_id`),
    KEY `article_id` (`article_id`),
    FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `order_configuration`
(
    `id`                int(11) unsigned NOT NULL AUTO_INCREMENT,
    `order_position_id` int(11) unsigned NOT NULL,
    `content_id`        int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `order_position_id` (`order_position_id`),
    KEY `content_id` (`content_id`),
    FOREIGN KEY (`order_position_id`) REFERENCES `order_position` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`content_id`) REFERENCES `content` (`id`)
        ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;
