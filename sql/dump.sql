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
       (2, 'Kugelschreiber', 'Ein Kugelschreiber mit schwarzer Tinte', 2.50, 'Kugelschreiber.jpg'),
       (3, 'Schere', 'Eine kleine Schere, passend fuer jedes Etui', 5.50, 'Schere.jpg'),
       (4, 'Feder', 'Der klassische \"Fuelli\"', 10.00, 'Feder.jpg'),
       (5, 'Lineal', 'Ein kleiner Lineal, 15cm lang', 5.00, 'Lineal.jpg'),
       (6, 'Zirkel', 'Ein Zirkel mit maximaler Spannweite von 30cm.', 15.50, 'Zirkel.jpg'),
       (7, 'Spitzer', 'Spitzer fuer Bleistifte', 3.50, 'Spitzer.jpg');

CREATE TABLE `configuration`
(
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT,
    `article_id` int(11) unsigned NOT NULL,
    `content_id` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `article_id` (`article_id`),
    KEY `content_id` (`content_id`),
    CONSTRAINT `configuration_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
    CONSTRAINT `configuration_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `customer`
(
    `id`             int(11) unsigned NOT NULL AUTO_INCREMENT,
    `firstname`      varchar(45)           DEFAULT NULL,
    `lastname`       varchar(45)           DEFAULT NULL,
    `street`         varchar(45)           DEFAULT NULL,
    `city`           varchar(45)           DEFAULT NULL,
    `zipcode`        int(4)                DEFAULT NULL,
    `telephone`      int(10)               DEFAULT NULL,
    `customer_since` timestamp        NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `order`
(
    `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
    `customer_id` int(11) unsigned NOT NULL,
    `date`        timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `annotations` varchar(255)              DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `customer_id` (`customer_id`),
    CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
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
    CONSTRAINT `order_position_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
    CONSTRAINT `order_position_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
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
    CONSTRAINT `order_configuration_ibfk_1` FOREIGN KEY (`order_position_id`) REFERENCES `order_position` (`id`),
    CONSTRAINT `order_configuration_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

